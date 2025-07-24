<?php

use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LiveTvController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsFetchController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SocailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatermarkController;
use App\Http\Controllers\WebsiteListController;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

// News Home page Route for Visitor Or Users
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


// Only Authoraization User can Access Backend Dashboard
Route::middleware(['web', 'auth', 'verified'])->group(function () {


    Route::get('/newsDashboard', function () {
        return view('layouts.newsDashboard.dashboard');
    })->name('dashboard');

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
        'websiteLIst' => WebsiteListController::class,
    ]);

    // Specific Version (Bangla/English) News Show Routes
    Route::prefix('news')->controller(NewsController::class)->group(function () {
        Route::get('/{id}/news_en', 'show_en')->name('news_en');
        Route::get('/{id}/news_bn', 'show_bn')->name('news_bn');
    });


    // Users  Urls
    Route::controller(UserController::class)->prefix('user')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/{id}/edit', 'edit')->name('user.edit');
        Route::put('/{id}/update', 'update')->name('user.update');
        Route::delete('/{id}/destroy', 'destroy')->name('user.destroy');
        Route::get('/{id}/resetphone', 'resetPhone')->name('user.phone.reset');
    });


    //SubCategories and SubDistricts via dropdown with the help of ajax
    Route::get('/get/subcategories/{id}', [CategoryController::class, 'getSubcate']);
    Route::get('/get/subdist/{id}', [DistrictController::class, 'getSubdist']);

    // Route For Setting Socials and Seos
    Route::prefix('settings')->group(function () {

        // social links setting routes
        Route::get('/socials', [SocailController::class, 'index'])->name('social.index');
        Route::put('/socials/update/{id}', [SocailController::class, 'update'])->name('social.udpate');

        // SEO's Settings Routes
        Route::get('/seos', [SeoController::class, 'index'])->name('seo.index');
        Route::put('/seos/update/{id}', [SeoController::class, 'update'])->name('seo.udpate');

        // Live TV Settings Routes
        Route::get('/livetv', [LiveTvController::class, 'index'])->name('liveTV.index');
        Route::put('/livetv/update/{id}', [LiveTvController::class, 'update'])->name('liveTv.udpate');
        Route::get('/livetv/active/{id}', [LiveTvController::class, 'activeLiveTV'])->name('liveTV.active');
        Route::get('/livetv/deactive/{id}', [LiveTvController::class, 'deactiveLiveTv'])->name('liveTv.deactive');

        // Notices Setting Routes
        Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
        Route::put('/notice/update/{id}', [NoticeController::class, 'update'])->name('notice.udpate');
        Route::get('/notice/active/{id}', [NoticeController::class, 'activeNotice'])->name('notice.active');
        Route::get('/notice/deactive/{id}', [NoticeController::class, 'deactiveNotice'])->name('notice.deactive');

    });

    // Users  Urls
    // Route::get('/api/news',[NewsFetchController::class, 'fetch'])->name('apiNews');

    // test
    // Route::get('/test',[TestController::class, 'test']);

    // Route::controller(TestController::class)->group(function(){
    //     Route::get('/test', 'test')->name('test');
    // });
});

// 404 page not found error
Route::fallback(function () {
    return view('layouts.newsDashboard.dashboardErrors');
});

require __DIR__ . '/auth.php';
