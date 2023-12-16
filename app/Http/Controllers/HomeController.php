<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carousels = Carousel::all();
        $categories = Category::inRandomOrder()->limit(2)->get();

        return view('home', compact('carousels', 'categories'));
    }

    public function about()
    {
        return view('about');
    }


    public function contact()
    {
        return view('contact');
    }

    public function settingAdmin()
    {
        return view('Admin.setting');
    }

    public function settingUser()
    {
        return view('User.setting');
    }

    public function chat()
    {
        // Replace '123456789' with your actual WhatsApp number
        $adminPhoneNumber = '+6289684838111';

        // Redirect to the WhatsApp chat link
        $whatsappLink = "whatsapp://send?phone={$adminPhoneNumber}";
        return redirect()->to($whatsappLink);
    }
}
