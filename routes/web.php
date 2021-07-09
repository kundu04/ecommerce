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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
