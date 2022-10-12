<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});


// Admin Routes
Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::controller(AdminController::class)->group(function(){
        Route::get('/profile', 'show')->name('admin.profile');
        Route::get('/profile/edit/{id}', 'edit')->name('admin.profile.edit');
        Route::put('/profile/edit/{id}', 'update')->name('admin.profile.update');
        Route::get('/profile/password', 'editPassword')->name('admin.profile.password.edit');
        Route::put('/profile/password', 'updatePassword')->name('admin.profile.password.update');
    });
});

// Admin Brand All Routes
Route::prefix('brand')->middleware(['auth', 'role:admin'])->group(function(){
   Route::controller(BrandController::class)->group(function(){
     Route::get('/view', 'brandView')->name('all.brand');
     Route::post('/store', 'storeBrand')->name('brand.store');
     Route::get('/{id}/edit', 'editBrand')->name('edit.brand');
     Route::put('/{id}/edit', 'updateBrand')->name('update.brand');
     Route::delete('/{id}/delete', 'deleteBrand')->name('delete.brand');
   });
   
});

// User Routes
Route::get('/dashboard', function () {
    return view('frontend.dashboard');
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function(){
    Route::controller(UserProfileController::class)->group(function(){
        Route::get('/profile', 'userProfile')->name('user.profile');
        Route::put('/profile', 'userProfileUpdate')->name('user.profile.update');
        Route::get('/profile/password', 'editPassword')->name('user.profile.password.edit');
        Route::put('/profile/password', 'updatePassword')->name('user.profile.password.update');
    });
});

require __DIR__.'/auth.php';
