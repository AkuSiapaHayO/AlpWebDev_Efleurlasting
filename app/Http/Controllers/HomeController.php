<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Order;
use App\Models\Testimony;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $carousels = Carousel::all();
        $categories = Category::inRandomOrder()->limit(3)->get();
        $testimonies = Testimony::inRandomOrder()->limit(2)->get();
        $userId = auth()->id();

        $orderItems = OrderItem::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('home', compact('user', 'carousels', 'categories', 'testimonies', 'orderItems'));
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
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('User.setting', compact('orders'));
    }

    public function chat()
    {
        $adminPhoneNumber = '+628983979074';

        $whatsappLink = "whatsapp://send?phone={$adminPhoneNumber}";
        return redirect()->to($whatsappLink);
    }
}
