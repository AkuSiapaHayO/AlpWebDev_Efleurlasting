<?php

namespace App\Http\Controllers\Auth;

// require './vendor/autoload.php';

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:225', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'profile-image' => ['image']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (!empty($data['profile-image'])) {
            $data['profile-image'] = $data['profile-image']->store('images', ['disk' => 'public']);

            return User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
                'profile_image' => $data['profile-image'],
                'gender' => $data['gender'],
                'age' => $data['age'],
                'birthdate' => $data['birthdate'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'province' => $data['province'],
                'city' => $data['city'],
                'district' => $data['district'],
                'zipcode' => $data['zipcode'],
                'role_id' => 2,
            ]);
        } else {
            return User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
                'gender' => $data['gender'],
                'age' => $data['age'],
                'birthdate' => $data['birthdate'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'province' => $data['province'],
                'city' => $data['city'],
                'district' => $data['district'],
                'zipcode' => $data['zipcode'],
                'role_id' => 2,
            ]);
        }



    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        if (empty($user)) {
            redirect()->route('register');
        } else {
            Cart::create([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('login');
    }
}