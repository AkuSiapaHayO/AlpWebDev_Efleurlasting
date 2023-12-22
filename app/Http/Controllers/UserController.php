<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            'username' => ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'email', 'max:255'],
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
                $originalImagePath = public_path($user->profile_image);
                if (File::exists($originalImagePath)) {
                    File::delete($originalImagePath);
                }
            }

            $image = $validatedData['profile-image'];
            $imageName = 'User/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('User'), $imageName);

            $user->update([
                'profile_image' => $imageName
            ]);
        }

        return redirect()->route('user.edit', $user);
    }

    public function destroy(User $user)
    {
        $cart = $user->cart;

        if ($cart) {
            $cart->cartItems()->delete();
            $cart->delete();
        }

        if ($user->profile_image) {
            $originalImagePath = public_path($user->profile_image);
            if (File::exists($originalImagePath)) {
                File::delete($originalImagePath);
            }
        }

        $user->delete();
        
        return redirect()->route('login');
    }

    public function destroyProfileImage(User $user)
    {
        if ($user->profile_image) {
            $originalImagePath = public_path($user->profile_image);
            if (File::exists($originalImagePath)) {
                File::delete($originalImagePath);
                $user->update(['profile_image' => null]);
            }
        }

        return redirect()->route('user.edit', $user);
    }
}

