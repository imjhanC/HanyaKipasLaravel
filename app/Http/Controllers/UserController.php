<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    /**
     * USERS CRUD
     */
    public function logout(Request $request)
    {
        $request->session()->flush(); // Clear session data
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }


    public function getUserProfile($id)
    {
        $user = User::findOrFail($id);
        return view('profile.profile', compact('user'));
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            session([
                'user_id' => $user->user_id,
                'username' => $user->name
            ]);
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin');
            } else {
                return redirect()->route('redirectuser');
            }
        }
        return back()->with('error', 'Invalid email or password.');
    }

    public function get_admin_page()
    {
        return view ('admin');
        //return 'This is admin page';
    }

    public function get_user_page()
    {
        return redirect()->route('productpage');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'User created successfully.');
    }

    public function showLoginForm()
    {
        // Check if user_id exists in session
        if (session()->has('user_id')) {
            // User is already logged in, redirect to product page
            return redirect()->route('productpage');
        }

        return view('login');
    }

    public function showRegisterForm()
    {
        // Check if user_id exists in session
        if (session()->has('user_id')) {
            // User is already logged in, redirect to product page
            return redirect()->route('productpage');
        }

        return view('register');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user);
    }
    /**
     * Admin User Management Methods
    */
    public function adminUserIndex()
    {
        $users = User::paginate(10);
        return view('adminUser', compact('users'));
    }

    public function adminUserCreate()
    {
        return view('admin.users.create');
    }

    public function adminUserStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function adminUserEdit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function adminUserUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id.',user_id',
            'role' => 'required|in:admin,user',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function adminUserDestroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting your own account
        if ($user->user_id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    public function admin_logout(Request $request)
    {
        $request->session()->flush(); // Clear session data
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    /**
     * Admin Product Management Methods
    */
    public function adminProductIndex()
    {
        $products = Product::with('company')->paginate(5);
        $companies = Company::all(); // Get all companies for the dropdown
        return view('adminProduct', compact('products', 'companies'));
    }

    public function adminProductStore(Request $request)
    {
        $data = $request->validate([
            'model' => 'required|string',
            'p_desc' => 'required|string',
            'company_id' => 'required',
            'p_category' => 'required|string',
            'p_price' => 'required|numeric',
            'p_img' => 'nullable|image|max:2048',
        ]);

        // Handle image upload and conversion to base64
        if ($request->hasFile('p_img')) {
            $imageData = base64_encode(file_get_contents($request->file('p_img')));
            $data['p_img'] = $imageData;
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }

    public function adminProductEdit($id)
    {
        $product = Product::with('company')->findOrFail($id);
        return response()->json($product);
    }

    public function adminProductUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'model' => 'required|string',
            'p_desc' => 'required|string',
            'company_id' => 'required',
            'p_category' => 'required|string',
            'p_price' => 'required|numeric',
            'p_img' => 'nullable|image|max:2048',
        ]);

        // Handle image upload if a new one is provided
        if ($request->hasFile('p_img')) {
            $imageData = base64_encode(file_get_contents($request->file('p_img')));
            $data['p_img'] = $imageData;
        } else {
            // Remove p_img from data to prevent overwriting with null
            unset($data['p_img']);
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function adminProductDestroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

    /**
     * Admin Cart Methods
    */
    public function adminOrdersIndex()
    {
        $carts = Cart::with(['product', 'user'])
            ->orderBy('product_id', 'desc')
            ->paginate(10);

        return view('adminCart', compact('carts'));
    }

    public function adminOrderDestroy($product_id, $user_id)
    {
        try {
            // Find the cart entry
            $cart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->delete();

            if (!$cart) {
                return redirect()->route('admin.orders')->with('error', 'Order not found.');
            }

            // Delete the cart entry

            return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders')->with('error', 'Failed to delete the order.');
        }
    }
}
