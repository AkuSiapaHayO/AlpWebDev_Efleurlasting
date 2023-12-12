<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:225', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'name' => $validatedData['name'],
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

    public function updateProfileImage(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'profile-image' => ['required', 'image']
        ]);

        if ($request->file('profile-image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $validatedData['profile-image'] = $request->file('profile-image')->store('images', ['disk' => 'public']);
            
            $user->update([
                'profile_image' => $validatedData['profile-image']
            ]);
        }

        return redirect()->route('user.edit', $user);
    }

    // Delete a record
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('login');
    }

    public function destroyProfileImage(User $user) {
        if ($user->profile_image) {
            if (Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
                $user->update(['profile_image' => null]);
            }
        }

        return redirect()->route('user.edit', $user);
    }
}

