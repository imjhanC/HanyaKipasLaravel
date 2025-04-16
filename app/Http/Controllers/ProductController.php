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
        $products = DB::table('products')->get();

        // Pass the data to the view
        return view('productpage', compact('products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Case-insensitive search on 'model' column
        $products = Product::whereRaw('LOWER(model) LIKE ?', ['%' . strtolower($query) . '%'])->get();

        return view('productpage', compact('products', 'query'));
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->query('category');

        if ($category == 'all' || $category == null) {
            // Fetch all products if 'all' or no category is selected
            $products = DB::table('products')->get();
        } else {
            // Fetch products that match the selected category
            $products = DB::table('products')->where('p_category', $category)->get();
        }

        // Pass the filtered data to the view
        return view('productPage', compact('products','category'));
}
}
