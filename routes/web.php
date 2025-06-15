<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Models\News;
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

// Profile Routes
Route::controller(ProfileController::class)->prefix('edit/profile')->middleware('auth')->group(function () {
    Route::get('/', 'edit')->name('profile.edit');
    Route::patch('/', 'update')->name('profile.update');
    Route::delete('/', 'destroy')->name('profile.destroy');
    Route::post('/phoneNumberAdd', 'phone_add')->name('phone.add');
    Route::post('/sendOTP', 'send_otp')->name('otp.send');
    Route::post('/verifyNumber', 'verify_number')->name('verify.number');
    Route::post('/updateNumber', 'update_number')->name('update.number');
    Route::post('/photoUpload', 'photo_upload')->name('photo.upload');
});

// user Profile Show Route

Route::controller(ProfileController::class)->prefix('profile')->group(function () {
    Route::get('/', 'index')->name('profile.index');
});

Route::resources([
    'news' => NewsController::class,
    'categories' => CategoryController::class,
]);





// test
// Route::get('/test',[TestController::class, 'test']);

// Route::controller(TestController::class)->group(function(){
//     Route::get('/test', 'test')->name('test');
// });

Route::fallback(function () {
    return view('layouts.newsDashboard.dashboardErrors');
});

require __DIR__ . '/auth.php';
