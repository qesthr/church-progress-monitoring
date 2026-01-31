<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login/register page
    public function showLoginRegister()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            return match (Auth::user()->role) {
                'pastor' => redirect('/dashboard/pastor'),
                'leader' => redirect('/dashboard/leader'),
                default => redirect('/dashboard/disciple'),
            };
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:pastor,leader,disciple'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'leader_id' => $request->leader_id ?? null,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Redirect based on role
        return match ($user->role) {
            'pastor' => redirect('/dashboard/pastor'),
            'leader' => redirect('/dashboard/leader'),
            default => redirect('/dashboard/disciple'),
        };
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
