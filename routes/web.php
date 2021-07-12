<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    
//     return view('frontend/home');
// });
Route::get('/',[App\Http\Controllers\frontend\FrontController::class, 'index'])->name('frontend.home');

Route::get('/cart',[App\Http\Controllers\frontend\CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart',[App\Http\Controllers\frontend\CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart/remove',[App\Http\Controllers\frontend\CartController::class, 'removeCart'])->name('cart.remove');
Route::get('/cart/clear',[App\Http\Controllers\frontend\CartController::class, 'clearCart'])->name('cart.clear');

Route::get('product/{slug}',[App\Http\Controllers\frontend\ProductController::class, 'showDetails'])->name('product.details');

Route::get('/login',[App\Http\Controllers\frontend\AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[App\Http\Controllers\frontend\AuthController::class,'processLogin']);

Route::get('/register',[App\Http\Controllers\frontend\AuthController::class,'showRegisterForm'])->name('register');
Route::post('/register',[App\Http\Controllers\frontend\AuthController::class,'processRegister']);

Route::get('/activate/{token}',[App\Http\Controllers\frontend\AuthController::class,'activate'])->name('activate');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout',[App\Http\Controllers\frontend\AuthController::class,'logout'])->name('logout');
});