@extends('layout.layout')


@section('content')
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="New password">
        <input type="password" name="password_confirmation" required placeholder="Confirm new password">
        <button type="submit">Reset Password</button>
    </form>
@endsection
