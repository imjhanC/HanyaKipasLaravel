<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // Add to cart
    public function addToCart(Request $req)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('login');
        }

        $existingCartItem = Cart::where('user_id', $userId)
            ->where('product_id', $req->product_id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->qty += $req->qty;
            $existingCartItem->save();
            return back()->with('cart_update', 'Product quantity updated in cart!');
        } else {
            Cart::create([
                'product_id' => $req->product_id,
                'user_id' => $userId,
                'qty' => $req->qty,
            ]);
            return back()->with('cart_add', 'Product added to cart successfully!');
        }
    }

    // View cart
    public function view()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('login');
        }

        $cartItems = Cart::where('user_id', $userId)->get();
        $cart = [];

        foreach ($cartItems as $item) {
            $product = $item->product;
            $cart[$item->product_id] = [
                'model' => $product->model,
                'p_desc' => $product->p_desc,
                'p_img' => $product->p_img,
                'qty' => $item->qty,
                'price' => $product->price,
            ];
        }

        session(['cart' => $cart]);
        return view('cart');
    }

    // Update quantity
    public function update(Request $req)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('login');
        }

        Cart::where('user_id', $userId)
            ->where('product_id', $req->product_id)
            ->update(['qty' => $req->qty]);

        return redirect()->route('viewCart')->with('cart_update', 'Quantity updated!');
    }

    // Remove from cart
    public function remove(Request $req)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect('login');
        }

        Cart::where('user_id', $userId)
            ->where('product_id', $req->product_id)
            ->delete();

        return redirect()->route('viewCart')->with('cart_update', 'Item removed from cart!');
    }
}

