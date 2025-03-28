@extends('layout.layout')

@section('content')
    <div class="w-full bg-gray-900 text-white py-12 px-10 text-center">
        <h1 class="text-3xl font-semibold">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-gray-300 mt-2 text-lg">Good bye {{ auth()->user()->name }}</p>
    </div>

    <div class="w-full min-h-screen flex flex-wrap items-center justify-center gap-12 px-10 py-16 bg-gray-100">
        <div class="w-full md:w-1/2 max-w-md bg-white border border-gray-300 rounded-lg shadow-lg p-6 text-center">
            <img src="{{ asset('images/ian.jpg') }}" alt="Profile Image" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-md mx-auto">
            <h2 class="mt-4 text-xl font-semibold text-gray-800">User Profile</h2>
            
            <a href="https://www.facebook.com/vari.aries.9/" target="_blank" class="mt-4 inline-flex items-center gap-2 text-blue-700 hover:text-blue-900 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M22.675 0h-21.35C.595 0 0 .593 0 1.325v21.351C0 23.407.595 24 1.325 24h11.482v-9.294H9.694V11.24h3.113V8.569c0-3.1 1.894-4.787 4.66-4.787 1.324 0 2.462.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.764v2.31h3.59l-.467 3.466h-3.123V24h6.128c.73 0 1.325-.593 1.325-1.324V1.325C24 .593 23.407 0 22.675 0z"/>
                </svg>
                <span>Facebook Profile</span>
            </a>

            <a href="http://localhost/pangan/index.php" target="_blank" class="mt-6 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                View Activity
            </a>
        </div>
        <div class="w-full md:w-1/2 max-w-md bg-white border border-gray-300 rounded-lg shadow-lg p-6 flex flex-col items-center justify-center">
            <h2 class="text-xl font-semibold text-gray-800">Charles Ian Pangan</h2>
            <p class="text-gray-600 mt-2 text-center">Course: BSIT -3</p>
        </div>
    </div>
@endsection
