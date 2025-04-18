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

Route::get('/', [ProductController::class, 'index'])->name('productpage');
Route::get('/category', [ProductController::class, 'filterByCategory'])->name('filterByCategory');
Route::get('/productDetail/{id}', [ProductController::class, 'getProductDetail']);

Route::post('/addToCart', [CartController::class,'addToCart'])->name('addToCart');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login'); // Add a method to show the login form
Route::post('/login', [UserController::class, 'login']);
Route::get('/getproductpage',[UserController::class, 'get_user_page'])->name('redirectuser');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // All your admin routes go here
    Route::get('/',[UserController::class,'get_admin_page'])->name('admin');
    Route::post('/',[UserController::class,'get_admin_page'])->name('admin');
    Route::post('/users',[UserController::class,'adminUserIndex'])->name('admin.users');
    // admin management page
    Route::get('/users', [UserController::class, 'adminUserIndex'])->name('admin.users');
    Route::post('/users', [UserController::class, 'adminUserStore'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'adminUserEdit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'adminUserUpdate'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'adminUserDestroy'])->name('admin.users.destroy');
    // admin product management page 
    Route::get('/products', [UserController::class, 'adminProductIndex'])->name('admin.products');
    Route::post('/products/store', [UserController::class, 'adminProductStore'])->name('admin.product.store');
    Route::get('/products/{id}/edit', [UserController::class, 'adminProductEdit'])->name('admin.product.edit');
    Route::put('/products/update/{id}', [UserController::class, 'adminProductUpdate'])->name('admin.product.update');
    Route::delete('/products/delete/{id}', [UserController::class, 'adminProductDestroy'])->name('admin.product.destroy');
    // admin order management page
    Route::get('/orders', [UserController::class, 'adminOrdersIndex'])->name('admin.orders');
    Route::delete('/orders/{product_id}/{user_id}', [UserController::class, 'adminOrderDestroy'])->name('admin.orders.destroy');
    // admin logout 

    Route::post('/logout', [UserController::class, 'admin_logout'])->name('logout');
});

// Route::get('/admin',[UserController::class,'get_admin_page'])->name('admin');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register'); // Add a method to show the registration form
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/user/{id}', [UserController::class, 'getUserProfile'])->name('user.profile');

// Route::get('/homepage', function () {
//     return view('homepage'); // Ensure you have a homepage view
// })->name('homepage');

Route::post('/forget-cart-session', function(Request $request) {
    $data = $request->validate([
        'session_name' => 'required|string'
    ]);

    session()->forget($data['session_name']);
    return response()->json(['status' => 'success']);
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
