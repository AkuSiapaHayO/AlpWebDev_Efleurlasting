<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//Settings
Route::get('/setting/user', [HomeController::class, 'settingUser'])->middleware('auth')->name('user.setting');
Route::get('/setting/admin', [HomeController::class, 'settingAdmin'])->middleware('admin')->name('admin.setting');

//CRUD User
Route::get('/user/view', [UserController::class, 'index'])->middleware('admin')->name('user.view');
Route::get('/user/{id}/show', [UserController::class, 'show'])->middleware('admin')->name('user.show');
Route::get('/user/{user}/edit',[UserController::class, 'edit'])->middleware('auth')->name('user.edit');
Route::delete('/user/{user}/destroy', [UserController::class, 'destroy'])->middleware('auth')->name('user.destroy');
Route::put('/user/{user}/update', [UserController::class, 'update'])->middleware('auth')->name('user.update');


