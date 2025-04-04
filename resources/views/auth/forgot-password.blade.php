@extends('layout.layout')


@section('content')
    <h2>Forgot Password</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" required placeholder="Enter your email">
        <button type="submit">Send Reset Link</button>
    </form>
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif
@endsection
