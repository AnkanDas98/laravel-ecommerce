<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
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

// Admin Category All Routes
Route::prefix('category')->middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(CategoryController::class)->group(function(){
      Route::get('/view', 'viewCategory')->name('all.category');
      Route::post('/store', 'storeCategory')->name('store.category');
      Route::get('/{id}/edit', 'editCategory')->name('edit.category');
      Route::put('/{id}/edit', 'updateCategory')->name('update.category');
      Route::delete('/{id}/delete', 'deleteCategory')->name('delete.category');
    });
      //   SubCategory
      Route::controller(SubCategoryController::class)->group(function(){
      Route::get('/sub/view', 'viewSubCategory')->name('all.subCategory');
      Route::post('/sub/store', 'storeSubCategory')->name('store.subCategory');
      Route::get('/sub/{id}/edit', 'editSubCategory')->name('edit.subCategory');
      Route::put('/sub/{id}/edit', 'updateSubCategory')->name('update.subCategory');
      Route::delete('/sub/{id}/delete', 'deleteSubCategory')->name('delete.subCategory');
      });

       //   Sub SubCategory
       Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/sub/sub/view', 'viewSubSubCategory')->name('all.sub.subCategory');
        Route::post('/sub/sub/store', 'storeSubSubCategory')->name('store.sub.subCategory');
        Route::get('/sub/sub/{id}/edit', 'editSubSubCategory')->name('edit.sub.subCategory');
        Route::put('/sub/sub/{id}/edit', 'updateSubSubCategory')->name('update.sub.subCategory');
        Route::delete('/sub/sub/{id}/delete', 'deleteSubSubCategory')->name('delete.sub.subCategory');   
        
        Route::get('/subCategory/fetch/{id}', 'getSubCategory');
     });
    
 });

// Admin Products all Routes
Route::prefix('product')->middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(ProductController::class)->group(function(){
      Route::get('/add', 'addProduct')->name('add-product');
      Route::post('/store', 'storeProduct')->name('store.product');
    //   Route::get('/{id}/edit', 'editBrand')->name('edit.brand');
    //   Route::put('/{id}/edit', 'updateBrand')->name('update.brand');
    //   Route::delete('/{id}/delete', 'deleteBrand')->name('delete.brand');

    Route::get('/subsubCategory/fetch/{id}', 'getSubSubCategory');
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
