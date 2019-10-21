<?php

namespace WeblaborMx\SparkManualBilling\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount('teams');
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
            'password_raw' => 'required|string|min:6'
        ];
        \Validator::make($request->all(), $rules)->validate();
        User::create($request->all());
        flash('User created successfully')->success();
        return redirect('spark/kiosk/users');
    }

    public function edit(User $user)
    {
        return view('spark-manual-billing::users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
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
        flash('User updated successfully')->success();
        return back();
    }
}
