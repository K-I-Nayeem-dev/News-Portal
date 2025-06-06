<?php

use App\Http\Controllers\ProfileController;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Route;

// News Home page Route

Route::get('/', function () {

    // return Location::get('119.30.39.113');

    $now = Carbon::now();
    // return $now->format('l jS \\of F Y h:i:s A');

    return view('layouts.newsIndex.home', [

        'position' => Location::get('119.30.39.113')->cityName,

    ]);
});

Route::get('/newsDashboard', function () {
    return view('layouts.newsDashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(function(){
    return view('layouts.newsDashboard.dashboardErrors');
});

require __DIR__ . '/auth.php';