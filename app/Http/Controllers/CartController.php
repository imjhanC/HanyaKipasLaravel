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
        else{
            Cart::create([
                'product_id' => $req->product_id,
                'user_id' => $req->user_id,
                'qty' => $req->qty,
            ]);
        }
    }
}
