<?php

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/verify', 'VerifyController@index')->name('verify');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shop', 'ShopController@index')->name('shop');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/admin', 'AdminController@index')->middleware('admin')->name('admin');

Route::get('/shop/category','CategoryController@viewCategoryHead')->name('viewCategory');
//Sort Products
Route::get('/shop/category/{id}','ShopController@listByCat')->name('byCat');
//View Specific Product
Route::get('/shop/viewProduct/{id}','ShopController@viewProduct');

/**
 * Frontend Routes
 */
Route::group(['middleware' => ['verified'],['auth']],function(){

    //Add to Cart Route
    Route::match(['get','post'], '/shop/addToCart','CartController@addToCart');
    //Cart Page
    Route::match(['get','post'], '/shop/cart','CartController@cart')->name('cart');
    //Delete Cart item
    Route::get('/shop/cart/deleteCartItem/{id}','CartController@deleteCartItem');
    //Update Cart Quantity
    Route::get('/shop/cart/updateCartQuantity/{id}/{quantity}','CartController@updateCartQuantity');

    Route::get('/shop/checkout','CheckoutController@index');
    /// Apply Coupon Code
    Route::post('/shop/cart/applyCoupon','CouponController@applyCoupon');
    //Order Route
    Route::get('/shop/checkoutSuccess','OrderController@index');
    Route::match(['get','post'], '/shop/checkoutOrder','OrderController@order');
    //User view orders
    Route::get('/orders','OrderController@viewOrders');
    //Cancel Order
    Route::post('/orders/cancelOrder/{id}','OrderController@cancelOrder')->name('orders.cancel');
});

/**
 * Admin Routes
 */
Route::group(['middleware' => ['auth'],['admin']],function(){

    //Dashboard
    Route::resource('/admin/dashboard','DashboardController');

    //Category Routes (Admin)
    Route::match(['get','post'], '/admin/addCategory','CategoryController@addCategory');
    Route::match(['get','post'], '/admin/editCategory/{id}','CategoryController@editCategory');
    Route::match(['get','post'], '/admin/deleteCategory/{id}','CategoryController@deleteCategory');
    Route::get('/admin/check_category_name','CategoryController@checkCateName');
    Route::get('/admin/viewCategory','CategoryController@viewCategory');

    //Product Routes (Admin)
    Route::match(['get','post'], '/admin/addProduct','ProductsController@addProducts');
    Route::match(['get','post'], '/admin/editProduct/{id}','ProductsController@editProduct');
    Route::get('/admin/viewProduct','ProductsController@viewProduct');
    Route::get('/admin/deleteProduct/{id}','ProductsController@deleteProduct');
    Route::get('/admin/deleteProductImage/{id}','ProductsController@deleteProductImage');

    //Coupon routes (Admin)
    Route::resource('/admin/coupon','CouponController');
    Route::get('/admin/coupon/deleteCoupon/{id}','CouponController@destroy');

    //View Orders
    Route::get('/admin/viewOrders','OrderController@viewOrdersAdmin');
    Route::get('/admin/delivery','OrderController@viewOrdersAdminDelivery');

    //For Delivery
    Route::match(['get','post'], '/admin/viewOrders/{id}','OrderController@forDelivery')->name('orders.delivery');
});
