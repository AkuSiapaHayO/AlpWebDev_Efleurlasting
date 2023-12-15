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
        $categories = Category::inRandomOrder()->limit(3)->get();

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
}
