<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

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

        // Get search history for logged in users
        $searchHistory = $this->getUserSearchHistory();

        // Pass the data to the view
        return view('productpage', compact('products', 'searchHistory'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Save search history if user is logged in and query exists
        if ($query && auth()->check()) {
            $this->saveSearchHistory($query);
        }

        // Case-insensitive search on 'model' column
        $products = Product::whereRaw('LOWER(model) LIKE ?', ['%' . strtolower($query) . '%'])->get();

        // Get search history for dropdown
        $searchHistory = $this->getUserSearchHistory();

        return view('productpage', compact('products', 'query', 'searchHistory'));
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

        // Get search history for logged in users
        $searchHistory = $this->getUserSearchHistory();

        // Pass the filtered data to the view
        return view('productPage', compact('products', 'category', 'searchHistory'));
    }

    private function saveSearchHistory($query)
    {
        // Get current user ID
        $userId = auth()->id();

        if (!$userId) {
            // If no user is logged in, do not save search history
            return;
        }

        // Create a unique cookie name for each user
        $cookieName = 'search_history_' . $userId;

        // Get existing search history
        $searchHistory = json_decode(request()->cookie($cookieName), true) ?? [];

        // Add new search to history (avoid duplicates)
        if (!in_array($query, $searchHistory)) {
            array_unshift($searchHistory, $query); // Add to beginning
            $searchHistory = array_slice($searchHistory, 0, 3); // Keep only last 3 searches
        }

        // Save updated history to cookie (expires in 30 days)
        $minutes = 60 * 24 * 30; // 30 days
        Cookie::queue($cookieName, json_encode($searchHistory), $minutes);
    }

    private function getUserSearchHistory()
    {
        // Get current user ID
        $userId = auth()->id();

        if (!$userId) {
            return [];
        }

        // Get cookie for the current user
        $cookieName = 'search_history_' . $userId;
        $searchHistory = json_decode(request()->cookie($cookieName), true) ?? [];

        return $searchHistory;
    }
}
