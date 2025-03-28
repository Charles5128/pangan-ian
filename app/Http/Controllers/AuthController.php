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

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $rememberToken = Str::random(60);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => $rememberToken,
        ]);

        Mail::to($request->email)->send(new RegisterMail($user));

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

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        // Check if the email exists in the database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found. Please register first.'])->withInput();
        }

        if (!$user->email_verified_at) {
            return back()->withErrors(['email' => 'Verify your email first!'])->withInput();
        }

        $remember = $request->has('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    /**
     * Registered User View
     */
    public function registered($id)
    {
        $user = User::findOrFail($id);
        return view('signin.registered', compact('user'));
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
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Logged out successfully.');
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
}
