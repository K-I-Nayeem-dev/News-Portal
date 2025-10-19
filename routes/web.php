<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LiveTvController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SocailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\WatermarkController;
use App\Http\Controllers\WebsiteListController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MostViewsNewsController;
use App\Http\Controllers\PollController;
use App\Models\BandwidthUsage;
use Illuminate\Support\Facades\Route;


//SubCategories and SubDistricts via dropdown with the help of ajax
Route::get('/get/subcategories/{id}', [CategoryController::class, 'getSubcate']);
Route::get('/get/dist/{id}', [DivisionController::class, 'getDist']);
Route::get('/get/subdist/{id}', [DistrictController::class, 'getSubdist']);


// News Home page Route for Visitor Or Users
Route::controller(HomeController::class)->group(function () {

    // Route for Home Page
    Route::get('/', 'index')->name('home')->middleware(['track.visitors', 'track.bandwidth']);

    // Route For Dynamic Localizaiton or Multilangual (English & Bangla)
    Route::get('/lang/english', 'english')->name('news.english');
    Route::get('/lang/bangla', 'bangla')->name('news.bangla');

    // Route For  Live TV watch
    Route::get('/livetv', 'livetv')->name('live.tv');

    // Route For  Video Gallery
    Route::get('/video-gallery', 'videogallery')->name('video.gallery');

    // Route for Photo Gallery
    Route::get('/photo-gallery', 'photogallery')->name('photo.gallery');

    Route::prefix('news')->group(function () {

        // Archive news

        Route::get('/archive/{date}', 'archive')->name('archive.news');

        // Location Search with division->district->subdistrict
        Route::get('/location/search', 'searchByLocation')->name('location.search');

        // 1. Add route in routes/web.php
        Route::get('/search', 'search')->name('news.search');

        // Route to show news by tag
        Route::get('/tag/{slug}', 'getTagNews')->name('tag.news');

        // For Single News View Method
        Route::get('/{category}/{subcategory?}/{id}', 'showFull_news')->name('showFull.news');

        // For Category Wise news Show
        Route::get('/{categoryName}', 'getCate_news')->name('getCate.news');

        // For SubCategory Wise news Show
        Route::get('/{category}/{subcategory}', 'sub_cate_news')->name('news.sub_cates');
    });

    // For track Ads click
    Route::get('/ads/click/{ad}', [AdsController::class, 'trackClick'])->name('ads.trackClick');
    Route::get('/admin/ads/performance', [AdsController::class, 'performance'])->name('ads.performance');
    Route::get('/admin/ads/{ad}/clicks', [AdsController::class, 'viewClicks'])->name('ads.view');

    // Language Switcher
    Route::get('/language/{locale}', [PollController::class, 'switchLanguage'])->name('language.switch');

    // Public Poll Routes (No Login Required)
    Route::get('/all/polls', 'all_polls')->name('all.polls');
    Route::post('/polls/{id}/vote', [PollController::class, 'vote'])->name('polls.vote');
    Route::get('/polls/{poll}/modal', [PollController::class, 'showModal'])->name('polls.modal');
});


// Accept invitation (click from email)
Route::get('/accept-invite/{token}', [InvitationController::class, 'accept'])->name('invitations.accept');

// Complete invitation (set password)
Route::post('/complete-invite', [InvitationController::class, 'complete'])->name('invitations.complete');



// Only Authoraization User can Access Backend Dashboard
Route::middleware(['web', 'auth', 'verified'])->group(function () {


    // Dashboard Controller
    Route::get('/newsDashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('track.bandwidth');

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
        Route::put('/profile/password/update', 'updatePassword')->name('update.password');
    });

    // Route for Bandwidth cards without controller
    Route::get('/bandwidth', function () {
        $bandwidths = BandwidthUsage::orderBy('id', 'desc')->get();
        return view('layouts.newsDashboard.bandwidth.index', compact('bandwidths'));
    })->name('bandwidth.index');

    // user Profile Show Route

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'index')->name('profile.index');
    });

    // Resource Urls
    Route::resources([
        'dashboard_news' => NewsController::class,
        'categories' => CategoryController::class,
        'breaking_news' => BreakingNewsController::class,
        'sub_categories' => SubCategoryController::class,
        'watermark' => WatermarkController::class,
        'invitations' => InvitationController::class,
        'district' => DistrictController::class,
        'subdistrict' => SubDistrictController::class,
        'division' => DivisionController::class,
        'websiteLIst' => WebsiteListController::class,
        'photogallery' => PhotoGalleryController::class,
        'videogallery' => VideoGalleryController::class,
        'ads' => AdsController::class,
        'website_setting' => WebsiteSettingController::class,
        'tags' => TagsController::class,
        'polls' => PollController::class,
    ]);

    // Specific Version (Bangla/English) News Show Routes
    Route::prefix('dashboard_news')->controller(NewsController::class)->group(function () {
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

    // Routes For  Permission CRUD
    Route::prefix('/permission')->middleware('auth')->controller(PermissionController::class)->group(function () {
        Route::get('/', 'index')->name('permission.index');
        Route::get('/create', 'create')->name('permission.create');
        Route::post('/store', 'store')->name('permission.store');
        Route::get('/{id}/edit', 'edit')->name('permission.edit');
        Route::put('/{id}/update', 'update')->name('permission.update');
        Route::delete('/{id}/destroy', 'destroy')->name('permission.destroy');
    });

    // Routes For  Roles CRUD
    Route::prefix('/role')->middleware('auth')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('role.index');
        Route::get('/create', 'create')->name('role.create');
        Route::post('/store', 'store')->name('role.store');
        Route::get('/{id}/edit', 'edit')->name('role.edit');
        Route::put('/{id}/update', 'update')->name('role.update');
        Route::delete('/{id}/destroy', 'destroy')->name('role.destroy');
    });

    // Menu builder routes
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::post('/menu/update-category-order', [MenuController::class, 'updateCategoryOrder'])->name('admin.menu.update-category-order');
        Route::post('/menu/update-subcategory-order', [MenuController::class, 'updateSubCategoryOrder'])->name('admin.menu.update-subcategory-order');
        Route::post('/menu/reorder-all', [MenuController::class, 'reorderAll'])->name('admin.menu.reorder-all');
    });

    // Track Most Views News routes
    Route::group(['prefix' => 'admin', 'controller' => MostViewsNewsController::class], function () {
        Route::get('/track/most-views/', 'index')->name('mvtn.index');
        Route::get('/track/most-views/{news}', 'show')->name('mvtn.show');
    });


});



// 404 page not found error
Route::fallback(function () {
    return view('layouts.newsDashboard.dashboardErrors');
});

// 404 page not found error for user invitation
Route::get('/invitation-invalid', function () {
    return view('layouts.newsDashboard.dashboardErrors');
});



require __DIR__ . '/auth.php';