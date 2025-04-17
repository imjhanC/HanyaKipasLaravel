<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $req)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }

        $userId = session('user_id');
        $productId = $req->product_id;
        $quantity = $req->qty;

        // Validate quantity
        if ($quantity <= 0) {
            return back()->with('error', 'Quantity must be at least 1.');
        }

        $existingCartItem = Cart::where('user_id', $userId)
                              ->where('product_id', $productId)
                              ->first();

        if ($existingCartItem) {
            // Update quantity if product exists
            Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->update([
                    'qty' => $existingCartItem->qty + $quantity
                ]);

            $message = 'Product quantity updated in cart!';
            return back()->with('success', $message);
        } else {
            // Create new cart item if product doesn't exist
            Cart::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'qty' => $quantity,
            ]);
            $message = 'Product added to cart successfully!';
            return back()->with('success', $message);
        }
    }

    public function showCart(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }

        $userId = session('user_id');

        // Fetch the cart items with product details using join
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($cartItem) {
                if (!$cartItem->product) {
                    return null;
                }

                return [
                    'cart_id' => $cartItem->id,
                    'product_id' => $cartItem->product_id,
                    'model' => $cartItem->product->model,
                    'p_img' => $cartItem->product->p_img,
                    'p_price' => $cartItem->product->p_price,
                    'qty' => $cartItem->qty,
                    'total_price' => $cartItem->product->p_price * $cartItem->qty,
                ];
            })
            ->filter();

        $grandTotal = $cartItems->sum('total_price');

        return view('cart', compact('cartItems', 'grandTotal'));
    }

    public function updateCart(Request $request)
    {
        $userId = session('user_id');
        $productId = $request->product_id; // Use product_id from request
        $quantity = $request->qty;

        try {
            // Find the cart item by user_id and product_id
            $cartItem = Cart::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

            if (!$cartItem) {
                return response()->json([
                    'error' => 'Item not found in cart',
                    'debug' => [
                        'user_id' => $userId,
                        'product_id' => $productId
                    ]
                ], 404);
            }

            // If quantity is 0 or less, remove the item
            if ($quantity <= 0) {
                $cartItem->delete();
                return response()->json(['success' => 'Item removed from cart']);
            }

            // Update quantity
            if (!isset($cartItem->qty)) {
                return response()->json([
                    'error' => 'Cart item does not have a qty column',
                    'debug' => $cartItem
                ], 500);
            }

            Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->update(['qty' => $quantity]);

            // Get updated cart info
            $product = Product::where('product_id', $productId)->first();

            if (!$product) {
                return response()->json([
                    'error' => 'Product not found',
                    'debug' => ['product_id' => $productId]
                ], 500);
            }

            $totalPrice = $product->p_price * $quantity;

            $grandTotal = Cart::where('user_id', $userId)
                            ->join('products', 'carts.product_id', '=', 'products.product_id')
                            ->sum(\DB::raw('products.p_price * carts.qty'));

            return response()->json([
                'success' => 'Cart updated',
                'item_total' => number_format($totalPrice, 2),
                'grand_total' => number_format($grandTotal, 2),
                'cart_count' => $this->getCartCount(),
                'redirect' => url('/cart')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    public function removeFromCart(Request $request)
    {
        $userId = session('user_id');
        $productId = $request->product_id; // Use product_id from request

        try {
            $deleted = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => 'Item removed from cart',
                    'cart_count' => $this->getCartCount()
                ]);
            }

            return response()->json([
                'error' => 'Item not found in cart',
                'debug' => [
                    'user_id' => $userId,
                    'product_id' => $productId
                ]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while trying to remove item',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }


    public static function getCartCount()
    {
        if (!session()->has('user_id')) {
            return 0;
        }

        $userId = session('user_id');
        return Cart::where('user_id', $userId)->sum('qty');
    }
}