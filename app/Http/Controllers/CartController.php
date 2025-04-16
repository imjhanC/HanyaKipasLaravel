<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    function addToCart(Request $req){
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }
        $userId = session('user_id');

        $existingCartItem = Cart::where('user_id', $userId)
                              ->where('product_id', $req->product_id)
                              ->first();

        if ($existingCartItem) {
        // Update quantity if product exists
            Cart::where('user_id', $userId)
                ->where('product_id', $req->product_id)
                ->update([
                    'qty' => $existingCartItem->qty + $req->qty
            ]);
            $message = 'Product quantity updated in cart!';
            return back()->with('cart_update', $message);
        } else {
            // Create new cart item if product doesn't exist
            Cart::create([
                'product_id' => $req->product_id,
                'user_id' => $userId,
                'qty' => $req->qty,
            ]);
            $message = 'Product added to cart successfully!';
            return back()->with('cart_add', $message);
        }
    }

    public function showCart(Request $request)
    {
        // Check if the user is logged in
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }

        // Get the logged-in user's ID
        $userId = session('user_id');

        // Fetch the cart items for the user
        $cartItems = Cart::where('user_id', $userId)
            ->get()
            ->map(function ($cartItem) {
                $product = Product::where('product_id', $cartItem->product_id)->first();
                
                if (!$product) {
                    return null;
                }

                return [
                    'model' => $product->model,
                    'p_img' => $product->p_img,
                    'p_price' => $product->p_price,
                    'qty' => $cartItem->qty,
                    'total_price' => $product->p_price * $cartItem->qty,
                ];
            });

        // Calculate the total price for all items in the cart
        $grandTotal = collect($cartItems)->sum('total_price');
        // Pass the cart items and grand total to the view
        return view('cart', compact('cartItems', 'grandTotal'));
    }

    public static function getCartCount()
    {
        // Check if the user is logged in
        if (!session()->has('user_id')) {
            return 0;
        }

        // Get the logged-in user's ID
        $userId = session('user_id');

        // Count the number of items in the cart for the user
        return Cart::where('user_id', $userId)->sum('qty');
    }
}
