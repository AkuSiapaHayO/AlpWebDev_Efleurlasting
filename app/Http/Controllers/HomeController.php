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
        $categories = Category::inRandomOrder()->limit(2)->get();
        $testimonies = Testimony::all();
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
        return view('User.setting');
    }

    public function chat()
    {
        // Replace '123456789' with your actual WhatsApp number
        $adminPhoneNumber = '+628983979074';

        // Redirect to the WhatsApp chat link
        $whatsappLink = "whatsapp://send?phone={$adminPhoneNumber}";
        return redirect()->to($whatsappLink);
    }

    // public function testimonialProduct()
    // {
    //     // Get the currently authenticated user
    //     $user = Auth::user();

    //     // Load the orders with their items and related data
    //     $user->load('orders.items.productColor.product.colors');

    //     // Extract products from the loaded relationships
    //     $products = $user->orders->flatMap(function ($order) {
    //         return $order->items->flatMap(function ($item) {
    //             return $item->productColor->product;
    //         });
    //     })->unique();

    //     return view('home', compact('products'));
    // }
}
