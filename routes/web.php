<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Frontend\HomepageController;
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

//----------------------------------------------------------------------------------------//
// --------------------------------All Guest/User Routes---------------------------------------//
//----------------------------------------------------------------------------------------//
Route::get('/', [HomepageController::class, 'index']);

// Product Details page url
Route::get('/product/detail/{id}/{slug}', [HomepageController::class, 'productDetail']);

//Product Tag Route
Route::get('/product/tag', [HomepageController::class, 'productByTag']);


// Category Wise Product Route
Route::get('/category/{id}/{slug}', [HomepageController::class, 'productByCategory']);

// Product Preview
Route::get('/product/view/modal/{id}', [HomepageController::class, 'productPreview']);

// Add to Cart
Route::post('/cart/data/store', [CartController::class, 'store'])->name('store.cart');

//fetch cart data
Route::get('/cart/data/get', [CartController::class, 'getCartData']);
//fetch cart data
Route::get('/cart/remove/{id}', [CartController::class, 'removeCartItem']);

// Language Routes
Route::get('/language/bangla', [LanguageController::class, 'bangla'])->name('language.bangla');
Route::get('/language/english', [LanguageController::class, 'english'])->name('language.english');

//Wishlist Route
Route::post('/wishlist/add', [WishlistController::class,'store']);

//Cart Page Route
Route::get('/cart', [CartPageController::class, 'viewCart'])->name('mycart');
Route::get('/get/cart', [CartPageController::class, 'getCart']);
Route::get('/cart/{rowId}', [CartPageController::class, 'updateCart']);

//Coupon Options Route
Route::post('/coupon-apply', [CartController::class,'applyCoupon']);
Route::get('/coupon/calculation', [CartController::class,'calculateCoupon']);
Route::get('/coupon/remove', [CartController::class,'removeCoupon']);



// Checkout
Route::get('/checkout', [CartController::class,'checkout'])->name('checkout');

//----------------------------------------------------------------------------------------//
// --------------------------------All Admin Routes---------------------------------------//
//----------------------------------------------------------------------------------------//
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
      Route::get('/manage', 'manageProducts')->name('manage.product');
      Route::get('/{id}/edit', 'editProduct')->name('edit.product');
      Route::put('/{id}/edit', 'updateProduct')->name('update.product');
      Route::post('/multi/image', 'addMultiImage')->name('add.multiImage');
      Route::put('/multi/image/update', 'updateMultiImage')->name('update.product-multiImage');
      Route::put('/thumbnail', 'updateThumbnailImage')->name('update.thumbnail');
      Route::delete('/multi/image/{id}/delete', 'deleteMultiImage')->name('delete.product-multiImage');
      Route::put('/status', 'updateProductStaus')->name('update.product.status');
      Route::delete('/{id}/delete', 'deleteProduct')->name('delete.product');

      Route::get('/subsubCategory/fetch/{id}', 'getSubSubCategory');
    });
    
 });

 Route::prefix('coupon')->middleware(['auth', 'role:admin'])->group(function(){
  Route::controller(CouponController::class)->group(function(){
    Route::get('/view', 'viewCoupons')->name('manage-coupon');
    Route::post('/store', 'storeCoupon')->name('store.coupon');
      Route::get('/{id}/edit', 'editCoupon')->name('edit.coupon');
      Route::put('/{id}/edit', 'updateCoupon')->name('update.coupon');
      Route::put('/status', 'updateCouponStatus')->name('update.coupon.status');
      Route::delete('/{id}/delete', 'deleteCoupon')->name('delete.coupon');
 });
 });

// Admin Slider Routes
 Route::prefix('slider')->middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(SliderController::class)->group(function(){
      Route::get('/view', 'sliderView')->name('all.slider');
      Route::post('/store', 'storeSlider')->name('store.slider');
      Route::get('/{id}/edit', 'editSlider')->name('edit.slider');
      Route::put('/{id}/edit', 'updateSlider')->name('update.slider');
    Route::put('/status', 'updateSliderStaus')->name('update.slider.status');
      Route::delete('/{id}/delete', 'deleteSlider')->name('delete.slider');
    });
    
 });

//  Shiping All Routes
Route::prefix('shipping')->middleware(['auth'])->group(function(){
  Route::controller(ShippingController::class)->group(function(){
    Route::get('/divison/view', 'divisonView')->middleware('role:admin')->name('all.divison');
    Route::post('/divison/store', 'storeDivison')->middleware('role:admin')->name('store.divison');
    Route::get('/divison/{id}/edit', 'editDivison')->middleware('role:admin')->name('edit.divison');
    Route::put('/divison/{id}/edit', 'updateDivison')->middleware('role:admin')->name('update.divison');
    Route::delete('/divison/{id}/delete', 'deleteDivison')->middleware('role:admin')->name('delete.divison');

    Route::get('/district/view', 'districtView')->middleware('role:admin')->name('all.district');
    Route::post('/district/store', 'storeDistrict')->middleware('role:admin')->name('store.district');
    Route::get('/district/{id}/edit', 'editDistrict')->middleware('role:admin')->name('edit.district');
    Route::put('/district/{id}/edit', 'updateDistrict')->middleware('role:admin')->name('update.district');
    Route::delete('/district/{id}/delete', 'deleteDistrict')->middleware('role:admin')->name('delete.district');

    Route::get('/state/view', 'stateView')->middleware('role:admin')->name('all.state');
    Route::post('/state/store', 'storeState')->middleware('role:admin')->name('store.state');
    Route::get('/state/{id}/edit', 'editState')->middleware('role:admin')->name('edit.state');
    Route::put('/state/{id}/edit', 'updateState')->middleware('role:admin')->name('update.state');
    Route::delete('/state/{id}/delete', 'deleteState')->middleware('role:admin')->name('delete.state');

    Route::get('/get/district/{divisonId}', 'getDistrict');
    Route::get('/get/state/{districtId}', 'getStates');
  });
  
});

//----------------------------------------------------------------------------------------//
// --------------------------------All User Routes---------------------------------------//
//----------------------------------------------------------------------------------------//

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

    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist');
    Route::get('/get/wishlist', [WishlistController::class, 'getWishlist']);
    Route::get('/remove/wishlist/{id}', [WishlistController::class, 'removeWishList']);

    Route::post('/checkout/store', [CheckoutController::class, 'storeCheckout'])->name('store.checkout');

    Route::get('/stripe/key', [StripeController::class, 'getStripeKey']);
    Route::post('/stripe/order', [StripeController::class, 'stripeOrder']);
});


require __DIR__.'/auth.php';
