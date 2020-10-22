<?php

namespace WeblaborMx\SparkManualBilling\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user_model;

    public function __construct()
    {
        $this->user_model = config('auth.providers.users.model');
    }

    public function index(Request $request)
    {
        $users = $this->user_model::withCount('teams');
        if($request->filled('search')) {
            $users = $users->where('name', 'like', $request->search.'%')->orWhere('email', 'like', $request->search.'%');
        }
        $users = $users->paginate(20);
        return view('spark-manual-billing::users.index', compact('users'));
    }

    public function create()
    {
        return view('spark-manual-billing::users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:254|unique:users,email',
            'password' => 'required|string|min:6'
        ];
        \Validator::make($request->all(), $rules)->validate();
        $user = new $this->user_model;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        flash(__(':name created successfully', ['name' => __('User')]))->success();
        return redirect('spark/kiosk/crud/users');
    }

    public function edit($user)
    {
        return view('spark-manual-billing::users.edit', compact('user'));
    }

    public function update($user, Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:254|unique:users,email,'.$user->id,
            'password_raw' => 'nullable|string|min:6'
        ];
        $requests = $request->all();
        \Validator::make($requests, $rules)->validate();
        if(is_null($requests['password_raw'])) {
            unset($requests['password_raw']);
        }
        $user->update($requests);
        flash(__(':name updated successfully', ['name' => __('User')]))->success();
        return back();
    }
}
