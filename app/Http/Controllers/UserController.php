<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show all records
    public function index()
    {
        $users = User::all();
        return view('Admin.User.view', compact('users'));
    }

    // Show a specific record
    public function show($id)
    {
        $user = User::find($id);
        return view('Admin.User.show', compact('user'));
    }

    // Create a new record
    // public function create()
    // {
        
    // }

    // Store a new record
    // public function store(Request $request)
    // {
    //     // Validate and store the data
    // }

    // Edit an existing record
    public function edit(User $user) 
    {
        $user = User::where('id', $user->id)->first();
        return view('User.edit', compact('user'));
    }

    // Update an existing record
    public function update(Request $request, User $user)
    {
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'zipcode' => $request->zipcode,
        ]);

        return redirect()->route('user.edit', $user);
    }

    // Delete a record
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('login');
    }
}

