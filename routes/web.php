<?php

use App\Http\Controllers\{
    BasicSettingController,
    CategoryController,
    DashboardController,
    FrontController,
    RoleController,
    GithubController,
    ProductController,
    SubcategoryController,
    VoucherController,
    WishlistController,
    CartController,
};
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// frontend
Route::get('/',[FrontController::class, 'index'])->name('frontend');
Route::get('/products',[FrontController::class, 'productView'])->name('frontend.product');
Route::get('/product/{slug}',[FrontController::class, 'productSingle'])->name('frontend.product.single');
Route::get('/get/color/size/{cid}/{pid}',[FrontController::class, 'getColorSizeId']);
Route::get('/wishlist/',[FrontController::class, 'wishlistIndex'])->name('frontend.wishlist.index');
Route::get('/wishlist/remove/{id}',[FrontController::class, 'wishlistRemove'])->name('frontend.wishlist.remove');

// wishlist add by ajax
Route::get('/wishlist/add/{product_id}',[FrontController::class, 'wishliststore']);
// Cart
Route::resource('cart', CartController::class);

// Dashboard
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Role Controller
Route::get('/dashboard/role/assign/user',[RoleController::class, 'assignUser'])->name('assign.user')->middleware('auth');
Route::post('/dashboard/role/assign/user/post',[RoleController::class, 'assignUserPost'])->name('assign.user.post')->middleware('auth');
Route::get('/dashboard/create/user',[RoleController::class, 'createUser'])->name('create.user')->middleware('auth');
Route::post('/dashboard/create/user/post',[RoleController::class, 'createUserPost'])->name('create.user.post')->middleware('auth');
Route::resource('/dashboard/role',RoleController::class)->middleware('auth');
// Basic Settings
Route::resource('/dashboard/basic-settings', BasicSettingController::class);
// Category
Route::resource('/dashboard/category', CategoryController::class)->middleware('auth');
// Subcategory
Route::resource('/dashboard/subcategory', SubcategoryController::class)->middleware('auth');
// Product
Route::get('/products/get/subcategory/{subcategory_id}',[ProductController::class,'getSubcategory'])->name('products.get.subcategory')->middleware('auth');
Route::get('/dashboard/product/image-gallery/{slug}',[ProductController::class,'productImageGallary'])->name('products.image.gallery')->middleware('auth');
Route::get('/dashboard/product/image-gallery/delete/{id}',[ProductController::class,'productImageGallaryDelete'])->name('products.image.gallery.delete')->middleware('auth');
Route::post('/dashboard/product/image-gallery/post',[ProductController::class,'productImageGallaryPost'])->name('products.image.gallery.post')->middleware('auth');
Route::get('/dashboard/product/stockout/{id}',[ProductController::class,'productStockout'])->name('products.stock.out')->middleware('auth');
Route::resource('dashboard/product', ProductController::class);

Route::get('/dashboard/voucher/trash/restore/{id}',[VoucherController::class, 'voucherRestore'])->name('voucher.restore')->middleware('auth');
Route::get('/dashboard/voucher/trash',[VoucherController::class, 'voucherTrashView'])->name('voucher.trash.index')->middleware('auth');
Route::get('/dashboard/voucher/deactive/{id}',[VoucherController::class, 'voucherDeactivate'])->name('voucher.deactivate')->middleware('auth');
Route::get('/dashboard/voucher/active/{id}',[VoucherController::class, 'voucherActive'])->name('voucher.active')->middleware('auth');
Route::get('/dashboard/voucher/deactivated-list',[VoucherController::class, 'voucherDeactivatedList'])->name('voucher.deactivate.list')->middleware('auth');
Route::resource('/dashboard/voucher', VoucherController::class)->middleware('auth');

// Wishlist
Route::get('/dashboard/wishlists',[WishlistController::class,'index'])->name('dashboard.wishlist')->middleware('auth');
// Socialite

Route::get('github/redirect',[GithubController::class,'githubRedirect']);
Route::get('github/callback',[GithubController::class,'githubCallback']);

require __DIR__.'/auth.php';
