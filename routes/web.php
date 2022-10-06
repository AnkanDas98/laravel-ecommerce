<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

require __DIR__.'/auth.php';
