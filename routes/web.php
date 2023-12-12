<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
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
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//Products + Category
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('showproduct');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('showcategory');

//CRUD Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/product/addcart', [CartItemController::class, 'store'])->name('cartitem.store');

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

//CRUD Product
Route::get('/setting/admin/products', [ProductController::class, 'adminindex'])->name('products.view');
Route::get('/setting/admin/product/{product}', [ProductController::class, 'adminshow'])->name('products.show');



