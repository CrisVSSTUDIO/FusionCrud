<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrashedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/email/verify', function () {

    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent ');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verification-notification', function () {
    // Logic to resend the verification notification
})->middleware(['throttle:6,1'])->name('verification.resend');
Route::get('register/request', [RegisterController::class, 'requestInvitation'])->name('requestInvitation');
Route::post('/invitation', [InvitationController::class, 'store'])->name('unlock');



Route::middleware(['auth','verified'])->group(function () {

    Route::get('/userinfo', [UserProfileController::class, 'index'])->name('getuserprofile');
    Route::put('/userinfo', [UserProfileController::class, 'update'])->name('userinfo');
    Route::get('allInvitations', [InvitationController::class, 'index'])->name('allInvitations');

    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'products' => ProductController::class,
        'categories' => CategoryController::class,
        'permission' => PermissionController::class,
       
    ]);
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::prefix('products')->group(function () {
        Route::get('/download/{product:slug}', [ProductController::class, 'downloadFile'])->name('download');
        Route::post('/{id}/restore', [ProductController::class, 'restore'])->name('restoreasset');
        Route::post('/{id}/forcedelete', [ProductController::class, 'forceDelete'])->name('deleteasset');
        /*         Route::resource('products', ProductController::class);
 */
    });
    Route::get('/trashed', [TrashedController::class, 'index'])->name('trashed');

    Route::post('/{id}/restore', [CategoryController::class, 'restore'])->name('restorecat');
    Route::post('/{id}/forcedelete', [CategoryController::class, 'forceDelete'])->name('deletecat');

    // Route::get('/categories/{category}/products', ['CategoryController', 'index']);

    /* Route::post('/search', [SearchController::class, 'index'])->name('search');
    Route::resource('dashboard', UserDashboardController::class);
    Route::resource('tags', TagController::class); */
});
