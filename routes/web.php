<?php

use App\Http\Controllers\ProfileController;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {


    // return $position = Location::get('119.30.39.113');

    return view('layouts.newsIndex.index', [

        'position' => Location::get('119.30.39.113')->cityName,

    ]);
});

Route::get('/dashboard', function () {
    return view('layouts.newsDashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';