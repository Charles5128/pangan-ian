<?php

// use App\Http\Controllers\AuthController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function(){
//     return view('dashboard.index');
// })->name('dashboard')->middleware(['auth']);

// Route::match(['post', 'get'] , '/register', [AuthController::class, 'register']);
// Route::match(['post', 'get'], '/login', [AuthController::class, 'login'])->name('login');

// Route::get('/registered/{id}', [AuthController::class, 'registered'])->name('registered');

// Route::get('/verify/{id}', [AuthController::class, 'verify'])->name('verify');

// Route::get('/trysend', [AuthController::class, 'trysend']);

// Route::get('/verified', function (){
//     return view('verified.index');
// })->name('verified');

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\PasswordResetController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function(){
//     return view('dashboard.index');
// })->name('dashboard')->middleware(['auth']);

// Route::match(['post', 'get'], '/register', [AuthController::class, 'register']);
// Route::match(['post', 'get'], '/login', [AuthController::class, 'login'])->name('login');

// Route::get('/registered/{id}', [AuthController::class, 'registered'])->name('registered');
// Route::get('/verify/{id}', [AuthController::class, 'verify'])->name('verify');
// Route::get('/trysend', [AuthController::class, 'trysend']);

// Route::get('/verified', function (){
//     return view('verified.index');
// })->name('verified');

// // Forgot Password Routes
// Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
// Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
// Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])->name('password.update');



use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('signin.index');
});

// Dashboard (Protected Route)
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email Verification
Route::get('/registered/{id}', [AuthController::class, 'registered'])->name('registered');
Route::get('/verify/{id}', [AuthController::class, 'verify'])->name('verify');
Route::get('/trysend', [AuthController::class, 'trysend']);

// Verified Email Confirmation Page
Route::get('/verified', function () {
    return view('verified.index');
})->name('verified');

// Forgot Password Routes
// Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
// Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
// Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])->name('password.update');


Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])->name('password.update');
});