<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            $user = Auth::user();
            session([
                'user_id' => $user->id,
                'username' => $user->name
            ]);
            return redirect()->route('productpage');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
}
