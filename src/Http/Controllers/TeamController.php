<?php

namespace WeblaborMx\SparkManualBilling\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Laravel\Spark\TeamSubscription;
use Laravel\Spark\LocalInvoice;
use Illuminate\Http\Request;
use Laravel\Spark\Spark;
use Dompdf\Dompdf;

class TeamController extends Controller
{
    private $team_model;

    public function __construct()
    {
        $this->team_model = \App\Models\Team::class;
        if(!class_exists($this->team_model)) {
            $this->team_model = \App\Team::class;
        }
    }

    public function index(Request $request)
    {
        $teams = new $this->team_model;
        if($request->filled('search')) {
            $teams = $teams->where('name', 'like', $request->search.'%');
        }
        if($request->filled('user_id')) {
            $teams = $teams->whereHas('users', function($query) use ($request) {
                return $query->where('id', $request->user_id);
            });
        }
        $teams = $teams->paginate(20);
        return view('spark-manual-billing::teams.index', compact('teams'));
    }

    public function edit($team)
    {
        return view('spark-manual-billing::teams.edit', compact('team'));
    }

    public function update($team, Request $request)
    {
        $rules = [
            'plan' => 'required',
            'total' => 'required|numeric',
            'days' => 'nullable|numeric'
        ];
        \Validator::make($request->all(), $rules)->validate();

        // Create suscription
        $active_subscription = $team->subscriptions()->active()->orderBy('ends_at', 'desc')->first();
        if(!is_object($active_subscription)) {
            $start_date = now();
        } else {
            $start_date = $active_subscription->ends_at;
        }
        
        $suscription = [
            'team_id' => $team->id,
            'name' => 'default',
            'stripe_id' => 'manual',
            'stripe_plan' => $request->plan,
            'quantity' => 1,
            'ends_at' => $start_date->addDays($request->days)->format('Y-m-d H:i:s')
        ];
        TeamSubscription::create($suscription);

        // Create invoice
        $data = [
            'user_id' => $team->owner->id,
            'team_id' => $team->id,
            'provider_id' => 'manual',
            'total' => $request->total,
            'tax' => 0
        ];
        $invoice = LocalInvoice::create($data);

        // Send email
        Mail::send('spark-manual-billing::spark.emails.invoice-manually', compact('team'), function ($message) use ($invoice) {
            $pdf = $this->pdf($invoice);
            $details = Spark::$details;
            $message->subject($details['product'].' Invoice');
            $message->to($invoice->user->email);
            $message->attachData($pdf['output'], $pdf['file_name']);
        });

        flash(__(':name created successfully', ['name' => __('Suscription')]))->success();
        return redirect('spark/kiosk/crud/teams');
    }

    public function freeTrial($team)
    {
        return view('spark-manual-billing::teams.free-trial', compact('team'));
    }

    public function freeTrialSave($team, Request $request)
    {
        $rules = [
            'days' => 'required|numeric'
        ];
        \Validator::make($request->all(), $rules)->validate();

        // Detect date when the trial starts
        $start_date = $team->trial_ends_at;
        if($start_date->lte(now())) {
            $start_date = now();
        }

        // Save data
        $team->trial_ends_at = $start_date->addDays($request->days)->format('Y-m-d H:i:s');
        $team->save();
        flash(__(':name created successfully', ['name' => __('Free Trial')]))->success();
        return redirect('spark/kiosk/crud/teams');
    }

    public function invoice($team, LocalInvoice $invoice)
    {
        if($invoice->team_id != $team->id) {
            abort(404);
        }

        $pdf = $this->pdf($invoice);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf['output'];
        }, $pdf['file_name']);
    }

    private function pdf(LocalInvoice $invoice)
    {
        // Create view
        $details = Spark::$details;
        $suscription = TeamSubscription::where('team_id', $invoice->team_id)
            ->where('created_at', '>=', $invoice->created_at->subSeconds(10)->format('Y-m-d H:i:s'))
            ->where('created_at', '<=', $invoice->created_at->addSeconds(10)->format('Y-m-d H:i:s'))
            ->first();
        $view = View::make('spark-manual-billing::spark.receipt', compact('invoice', 'details', 'suscription'));
        
        // Create Pdf
        $dompdf = new Dompdf;
        $dompdf->loadHtml($view->render());
        $dompdf->render();
        $output = $dompdf->output();

        // Return response
        $file_name = $details['product'].'_'.$invoice->created_at->format('m_Y').'.pdf';
        return compact('output', 'file_name');
    }
}
