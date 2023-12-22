<?php

use App\Http\Controllers\CarouselController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestimonyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



//Authentication
Auth::routes();

//Main
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

//Products + Category
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');

//CRUD Cart + Order
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/product/cart/create', [CartItemController::class, 'store'])->name('cartitem.store');
Route::delete('/product/cart/cartitem/{cartitem}/destroy', [CartItemController::class, 'destroy'])->name('cartitem.delete');
Route::put('/product/cart/cartitem/{cartitem}/update', [CartItemController::class, 'update'])->name('cartitem.update');
Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
Route::get('/checkout/payment', [OrderController::class, 'finalize'])->name('order.finalize');
Route::post('/checkout/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/checkout/order', [OrderController::class, 'index'])->name('order.view');

//CRUD Testimonies
Route::post('/testimony', [TestimonyController::class, 'store'])->middleware('auth')->name('testimony.store');

//Settings
Route::get('/setting/user', [HomeController::class, 'settingUser'])->middleware('auth')->name('user.setting');
Route::get('/setting/admin', [HomeController::class, 'settingAdmin'])->middleware('admin')->name('admin.setting');

//CRUD User
Route::get('/user/view', [UserController::class, 'index'])->middleware('admin')->name('user.view');
Route::get('/user/{id}/show', [UserController::class, 'show'])->middleware('admin')->name('user.show');
Route::get('/user/{user}/edit',[UserController::class, 'edit'])->middleware('auth')->name('user.edit');
Route::put('/user/{user}/update', [UserController::class, 'update'])->middleware('auth')->name('user.update');
Route::put('/user/{user}/updateProfileImage', [UserController::class, 'updateProfileImage'])->middleware('auth')->name('user.updateProfileImage');
Route::delete('/user/{user}/destroy', [UserController::class, 'destroy'])->middleware('auth')->name('user.destroy');
Route::delete('/user/{user}/destroyProfileImage', [UserController::class, 'destroyProfileImage'])->middleware('auth')->name('user.destroyProfileImage');

//CRUD Product + tbh the name is too similar with that of the user so might update this
Route::get('/setting/admin/products', [ProductController::class, 'adminindex'])->middleware('admin')->name('products.view');
Route::get('/setting/admin/product/{product}', [ProductController::class, 'adminshow'])->middleware('admin')->name('products.show');
Route::get('/setting/admin/product/create/new', [ProductController::class, 'create'])->middleware('admin')->name('products.create');
Route::post('/setting/admin/product/save', [ProductController::class, 'store'])->middleware('admin')->name('products.store');
Route::get('/setting/admin/product/{product}/edit', [ProductController::class, 'edit'])->middleware('admin')->name('products.edit');
Route::put('/setting/admin/product/{product}/update', [ProductController::class, 'update'])->middleware('admin')->name('products.update');
Route::delete('/setting/admin/product/{product}/destroy', [ProductController::class, 'destroy'])->middleware('admin')->name('products.destroy');
Route::delete('/setting/admin/image/{image}/destroy', [ImageController::class, 'destroy'])->middleware('admin')->name('image.delete');
Route::post('/setting/admin/{product}/image/save', [ImageController::class, 'store'])->middleware('admin')->name('image.store');

//CRUD Carousels
Route::get('/setting/admin/carousel', [CarouselController::class, 'index'])->middleware('admin')->name('carousel.view');
Route::get('/setting/admin/carousel/create', [CarouselController::class, 'create'])->middleware('admin')->name('carousel.create');
Route::post('/setting/admin/carousel/store', [CarouselController::class, 'store'])->middleware('admin')->name('carousel.store');
Route::put('/setting/admin/carousel/{carousel}/update', [CarouselController::class, 'update'])->middleware('admin')->name('carousel.update');
Route::put('/setting/admin/carousel/{carousel}/updateImage', [CarouselController::class, 'updateImage'])->middleware('admin')->name('carousel.updateImage');
Route::delete('/setting/admin/carousel/{carousel}/destroy', [CarouselController::class, 'destroy'])->middleware('admin')->name('carousel.destroy');

//CRUD Category
Route::post('/setting/admin/category/create', [CategoryController::class, 'store'])->middleware('admin')->name('category.store');
Route::get('/setting/admin/category/{category}/edit', [CategoryController::class, 'edit'])->middleware('admin')->name('category.edit');
Route::put('/setting/admin/category/{category}/update', [CategoryController::class, 'update'])->middleware('admin')->name('category.update');
Route::delete('/setting/admin/category/{category}/destroy', [CategoryController::class, 'destroy'])->middleware('admin')->name('category.destroy');
Route::get('/setting/admin/categories', [CategoryController::class, 'adminindex'])->middleware('admin')->name('admin.categories.view');
Route::get('/setting/admin/category/{category}', [CategoryController::class, 'adminshow'])->middleware('admin')->name('admin.category.show');

//WhatsApp
Route::get('/home/chat', [HomeController::class, 'chat'])->name('chat.whatsapp');

//CRUD Colors
Route::get('/setting/admin/colors', [ColorController::class, 'index'])->middleware('admin')->name('colors.view');
Route::delete('/setting/admin/colors/{color}/destroy', [ColorController::class, 'destroy'])->middleware('admin')->name('color.destroy');

//CRUD Order
Route::get('/setting/admin/payment', [OrderController::class, 'paymentindex'])->middleware('admin')->name('payment.view');
Route::get('/setting/admin/payment/{order}', [OrderController::class, 'paymentshow'])->middleware('admin')->name('payment.show');
Route::get('/setting/admin/payment/{order}/approve', [OrderController::class, 'paymentapprove'])->middleware('admin')->name('payment.approve');
Route::get('/setting/admin/payment/{order}/delete', [OrderController::class, 'paymentdisapprove'])->middleware('admin')->name('payment.disapprove');
Route::get('/setting/admin/orders', [OrderController::class, 'adminindex'])->middleware('admin')->name('orders.view');
Route::get('/setting/admin/order/{order}/finish', [OrderController::class, 'orderfinish'])->middleware('admin')->name('order.finish');
