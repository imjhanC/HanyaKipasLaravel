<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/productpage', [ProductController::class, 'index']);
Route::get('/productpage', [ProductController::class, 'index'])->name('productpage');
Route::get('/productDetail/{id}', [ProductController::class, 'getProductDetail']);

Route::post('/addToCart', [CartController::class,'addToCart'])->name('addToCart');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login'); // Add a method to show the login form
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register'); // Add a method to show the registration form
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/user/{id}', [UserController::class, 'getUserProfile'])->name('user.profile');

Route::get('/homepage', function () {
    return view('homepage'); // Ensure you have a homepage view
})->name('homepage');

Route::post('/forget-cart-session', function(Request $request) {
    $data = $request->validate([
        'session_name' => 'required|string'
    ]);
    
    session()->forget($data['session_name']);
    return response()->json(['status' => 'success']);
});