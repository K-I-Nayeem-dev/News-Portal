<?php

use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatermarkController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Route;

// News Home page Route

Route::get('/', function () {

    $now = Carbon::now();

    $breaking_news = DB::table('breaking_news')->where('status', 1)->latest()->get();
    $time = DB::table('breaking_news')->latest()->get();

    return view('layouts.newsIndex.home', [

        'position' => Location::get('119.30.39.113')->cityName,
        'breaking_news' => $breaking_news,
        'time' => $time,

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

// Resource Urls
Route::resources([
    'news' => NewsController::class,
    'categories' => CategoryController::class,
    'breaking_news' => BreakingNewsController::class,
    'sub_categories' => SubCategoryController::class,
    'watermark' => WatermarkController::class,
    'invitations' => InvitationController::class,
    'district' => DistrictController::class,
    'subdistrict' => SubDistrictController::class,
]);



Route::controller(UserController::class)->prefix('user')->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::get('/create', 'create')->name('user.create');
    Route::post('/store', 'store')->name('user.store');
    Route::get('/{id}/edit', 'edit')->name('user.edit');
    Route::put('/{id}/update', 'update')->name('user.update');
    Route::delete('/{id}/destroy', 'destroy')->name('user.destroy');
    Route::get('/{id}/resetphone', 'resetPhone')->name('user.phone.reset');
});

// test
// Route::get('/test',[TestController::class, 'test']);

// Route::controller(TestController::class)->group(function(){
//     Route::get('/test', 'test')->name('test');
// });

Route::fallback(function () {
    return view('layouts.newsDashboard.dashboardErrors');
});

require __DIR__ . '/auth.php';