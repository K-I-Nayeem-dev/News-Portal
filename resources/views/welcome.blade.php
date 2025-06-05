@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Welcome to Laravel 12 with Breeze</h1>
        <p class="mt-4 text-lg text-gray-600">Your Laravel Breeze-powered starter page</p>
    </div>
    <div class="flex justify-center space-x-4">
        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Login</a>
        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">Register</a>
    </div>
</div>
@endsection
