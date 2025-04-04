<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    
     
    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('signin.index');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'remember_token' => Str::random(64),
        ]);

        Mail::to($user->email)->send(new RegisterMail($user));

        return redirect()->route('registered', ['id' => $user->id])
            ->with('status', 'Registration successful! Please check your email to verify.');
    }

    /**
     * Login User
     */
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('login.index');
        }

        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found. Please register first.'])->onlyInput('email');
        }

        if (!$user->email_verified_at) {
            return back()->withErrors(['email' => 'Verify your email first!'])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Registered User View
     */
    public function registered($id)
    {
        return view('signin.registered', ['user' => User::findOrFail($id)]);
    }

    /**
     * Verify User Email
     */
    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('status', 'Email is already verified.');
        }

        $user->update(['email_verified_at' => now()]);

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now log in.');
    }

    /**
     * Resend Email Verification Link
     */
    public function resendVerificationEmail($id)
    {
        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('status', 'Email is already verified.');
        }

        Mail::to($user->email)->send(new RegisterMail($user));

        return back()->with('status', 'Verification email resent successfully.');
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Logged out successfully.');
    }
    public function showLoginForm()
{
    return view('login.index'); 
}

}
