<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductDetail($productID){
        $product = Product::find($productId);
        return view('productDetail', ['product' => $product]);
    }
}
