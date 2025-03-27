<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    function addToCart(Request $req){
        $userId = session('user_id');
        if (!$userId) {
            return redirect('login');
        }

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
                'user_id' => $req->user_id,
                'qty' => $req->qty,
            ]);
            $message = 'Product added to cart successfully!';
            return back()->with('cart_add', $message);
        }
    }
}
