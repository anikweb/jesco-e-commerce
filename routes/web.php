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
    CheckoutController,
    MyAccountController,
    OrderController,
    SslCommerzPaymentController,
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
Route::get('/wishlist',[FrontController::class, 'wishlistIndex'])->name('frontend.wishlist.index');
Route::get('/wishlist/remove/{id}',[FrontController::class, 'wishlistRemove'])->name('frontend.wishlist.remove');

// wishlist add by ajax
Route::get('/wishlist/add/{product_id}',[FrontController::class, 'wishliststore']);
// Cart
Route::get('cart/voucher/remove',[CartController::class, 'cartRemoveVoucher'])->name('cart.remove.voucher');
Route::get('cart/delete/all',[CartController::class, 'cartDeleteAll'])->name('cart.all.delete');
Route::get('cart/delete/{slug}',[CartController::class, 'cartDelete'])->name('cart.delete');
Route::get('/cart/{voucher}',[CartController::class, 'index']);
Route::get('/cart/quantity/update/{cart_id}/{quantity}',[CartController::class, 'quantityUpdate']);
Route::resource('cart', CartController::class);
// Checkout
Route::resource('checkout', CheckoutController::class)->middleware(['auth','isCustomer']);
Route::get('/get/district/{division_id}',[CheckoutController::class,'getDistrict']);
Route::get('/get/upazila/{district_id}',[CheckoutController::class,'getUpazila']);

// Customer Dashboard
Route::get('/my-account/personal-information',[MyAccountController::class,'indexPersonalOnfo'])->name('my-account.personal.information')->middleware(['isCustomer','auth']);
Route::get('/my-account/personal-information/{username}/edit',[MyAccountController::class,'editPersonalOnfo'])->name('my-account.personal.information.edit')->middleware(['isCustomer','auth']);
Route::post('/my-account/personal-information/edit/update',[MyAccountController::class,'updatePersonalOnfo'])->name('my-account.personal.information.update')->middleware(['isCustomer','auth']);
// Customer Orders
Route::get('/my-account/orders/invoice/download/{billing_id}',[MyAccountController::class,'downloadInvoice'])->name('my-account.invoice.download')->middleware(['isCustomer','auth']);
Route::get('/my-account/orders/delivered',[MyAccountController::class,'indexDeliveredOrder'])->name('my-account.delivered.order')->middleware(['isCustomer','auth']);
Route::get('/my-account/orders',[MyAccountController::class,'indexOrders'])->name('my-account.orders')->middleware(['isCustomer','auth']);
Route::get('/my-account/orders/track',[MyAccountController::class,'indexTrack'])->name('my-account.orders.track')->middleware(['isCustomer','auth']);
Route::get('/my-account/orders/track/search/{invoice}',[MyAccountController::class,'TrackOrder'])->middleware(['isCustomer','auth']);
Route::resource('my-account', MyAccountController::class)->middleware(['isCustomer','auth']);
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
// Order
Route::get('/dashboard/orders/picup-in-progress/upgrade/shipped/{invoice_no}',[OrderController::class,'upgradeToShipped'])->middleware('auth');
Route::get('/dashboard/orders/picup-in-progress',[OrderController::class,'index'])->name('dashboard.orders.index')->middleware('auth');
Route::get('/dashboard/orders/shipped',[OrderController::class,'indexShipped'])->name('dashboard.orders.shipped')->middleware('auth');
Route::get('/dashboard/orders/shipped/upgrade/out-for-delivery/{invoice_no}',[OrderController::class,'upgradeToOutForDelivery'])->middleware('auth');
Route::get('/dashboard/orders/out-for-delivered',[OrderController::class,'indexOutForDelivered'])->name('dashboard.orders.outForDelivered')->middleware('auth');
Route::get('/dashboard/orders/out-for-delivered/upgrade/delivered/{invoice_no}',[OrderController::class,'upgradeToDelivered'])->middleware('auth');
Route::get('/dashboard/orders/delivered',[OrderController::class,'indexDelivered'])->name('dashboard.orders.delivered')->middleware('auth');
Route::get('/dashboard/orders/details/{invoice_no}',[OrderController::class,'indexDetails'])->name('dashboard.orders.details')->middleware('auth');
Route::get('/dashboard/orders/cancel/{invoice_no}',[OrderController::class,'cancelOrder'])->name('dashboard.orders.cancel')->middleware('auth');
Route::get('/dashboard/orders/canceled',[OrderController::class,'indexCanceled'])->name('dashboard.orders.canceled')->middleware('auth');

// Socialite

Route::get('github/redirect',[GithubController::class,'githubRedirect']);
Route::get('github/callback',[GithubController::class,'githubCallback']);

// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

require __DIR__.'/auth.php';
