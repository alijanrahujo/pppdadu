<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\UnionCouncilController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicPageController::class, 'home'])->name('home');

Route::controller(PublicPageController::class)->group(function () {
    Route::get('/about/president', 'showPresident')->name('pages.president');
    Route::get('/about/general-secretary', 'showGeneralSecretary')->name('pages.general-secretary');
    Route::get('/leadership', 'showLeadership')->name('pages.leadership');
    Route::get('/about/leadership', 'showLeadership');
    Route::get('/organization/leadership', 'showLeadership');
    Route::get('/organization/district-body', 'showDistrictBody')->name('pages.district-body');
    Route::get('/organization/municipal-bodies', 'showMunicipalBodies')->name('pages.municipal-bodies');
    Route::get('/organization/union-council-bodies', 'showUnionCouncilBodies')->name('pages.union-council-bodies');
    Route::get('/members-area', 'showMembers')->name('pages.members');
    Route::get('/members', 'showMembers');
    Route::get('/join', 'showMembership')->name('pages.join');
    Route::post('/join', 'storeMembership')->middleware('throttle:10,1')->name('pages.join.store');
    Route::get('/contact', 'showContact')->name('pages.contact');
    Route::post('/contact', 'storeContact')->middleware('throttle:10,1')->name('pages.contact.store');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // General Settings
        Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
        Route::post('/settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general.update');

        // Homepage Content Management
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/hero', [HomeController::class, 'hero'])->name('hero');
            Route::post('/hero', [HomeController::class, 'updateHero'])->name('hero.update');

            Route::get('/values', [HomeController::class, 'values'])->name('values');
            Route::post('/values', [HomeController::class, 'updateValues'])->name('values.update');

            Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
            Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');

            Route::get('/about', [HomeController::class, 'about'])->name('about');
            Route::post('/about', [HomeController::class, 'updateAbout'])->name('about.update');

            Route::get('/join', [HomeController::class, 'join'])->name('join');
            Route::post('/join', [HomeController::class, 'updateJoin'])->name('join.update');
        });

        // Public Pages Content Management
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/president', [PageContentController::class, 'president'])->name('president');
            Route::post('/president', [PageContentController::class, 'updatePresident'])->name('president.update');

            Route::get('/general-secretary', [PageContentController::class, 'generalSecretary'])->name('general-secretary');
            Route::post('/general-secretary', [PageContentController::class, 'updateGeneralSecretary'])->name('general-secretary.update');

            Route::get('/leadership', [PageContentController::class, 'leadership'])->name('leadership');
            Route::post('/leadership', [PageContentController::class, 'updateLeadership'])->name('leadership.update');

            Route::get('/district-body', [PageContentController::class, 'districtBody'])->name('district-body');
            Route::post('/district-body', [PageContentController::class, 'updateDistrictBody'])->name('district-body.update');

            Route::get('/municipal-bodies', [PageContentController::class, 'municipalBodies'])->name('municipal-bodies');
            Route::post('/municipal-bodies', [PageContentController::class, 'updateMunicipalBodies'])->name('municipal-bodies.update');

            Route::get('/union-councils', [PageContentController::class, 'unionCouncils'])->name('union-councils');
            Route::post('/union-councils', [PageContentController::class, 'updateUnionCouncils'])->name('union-councils.update');

            Route::get('/join', [PageContentController::class, 'joinPage'])->name('join');
            Route::post('/join', [PageContentController::class, 'updateJoinPage'])->name('join.update');

            Route::get('/contact', [PageContentController::class, 'contactPage'])->name('contact');
            Route::post('/contact', [PageContentController::class, 'updateContactPage'])->name('contact.update');
        });

        // Leaders (Leadership Carousel + District Body)
        Route::resource('leaders', LeaderController::class)->except(['show']);

        // Union Councils
        Route::resource('councils', UnionCouncilController::class)->parameters(['councils' => 'council'])->except(['show']);

        // Gallery
        Route::resource('gallery', GalleryController::class)->parameters(['gallery' => 'gallery'])->except(['show']);

        // Submissions Management
        Route::prefix('submissions')->name('submissions.')->group(function () {
            Route::get('/memberships', [SubmissionController::class, 'memberships'])->name('memberships');
            Route::get('/contacts', [SubmissionController::class, 'contacts'])->name('contacts');
            Route::patch('/{submission}/status', [SubmissionController::class, 'updateStatus'])->name('status');
            Route::delete('/{submission}', [SubmissionController::class, 'destroy'])->name('destroy');
        });
    });
});
