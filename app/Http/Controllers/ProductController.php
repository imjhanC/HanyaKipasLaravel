<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProductDetail($productID){
        $product = Product::find($productID);
        return view('productDetailPage', ['product' => $product]);
    }
    public function index()
    {
        // Fetch all data from the products table
        $products = DB::table('product')->get();

        // Pass the data to the view
        return view('productpage', compact('products'));
    }
}
