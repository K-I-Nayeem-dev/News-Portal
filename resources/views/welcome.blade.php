{{-- @extends('layouts.app')

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
@endsection --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

        {{-- <table class="table text-nowrap mb-0 align-middle">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all as $al)
                    <tr>
                        <th scope="row">{{ $al->id }}</th>
                        <td>{{ $al->name }}</td>
                        <td>{{ $al->email }}</td>
                        <td>{{ $al->role }}</td>
                        <td><a href="{{ $al->id }}">Link</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

    <div class="container">
        <div class="row">
            <div class="col-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ $all->id }}</th>
                            <th>{{ $all->name }}</th>
                            <th>{{ $all->email }}</th>
                            <th>{{ $all->role }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>


