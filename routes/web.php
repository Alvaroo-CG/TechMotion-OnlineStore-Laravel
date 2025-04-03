<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/products/load-more', 'App\Http\Controllers\ProductController@loadMore')->name("product.loadMore");
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");
Route::post('/products/{id}/comment', 'App\Http\Controllers\ProductController@addComment')->name('product.addComment');
Route::post('/products/{id}/rating', 'App\Http\Controllers\ProductController@addRating')->name('product.addRating');


Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete");
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add");

Route::middleware('auth')->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name("myaccount.orders");
    Route::get('/wishlist', 'App\Http\Controllers\WishlistController@index')->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', 'App\Http\Controllers\WishlistController@add')->name('wishlist.add');
    Route::delete('/wishlist/remove/{productId}', 'App\Http\Controllers\WishlistController@remove')->name('wishlist.remove');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
    Route::get('/admin/orders', 'App\Http\Controllers\Admin\AdminOrderController@index')->name('admin.orders.index');
    Route::get('/admin/orders/{id}', 'App\Http\Controllers\Admin\AdminOrderController@show')->name('admin.orders.show');

    // Rutas para gestión de cupones
    Route::get('/admin/coupons', 'App\Http\Controllers\Admin\AdminCouponController@index')->name('admin.coupons.index'); // Ver cupones
    Route::get('/admin/coupons/create', 'App\Http\Controllers\Admin\AdminCouponController@create')->name('admin.coupons.create'); // Crear cupón
    Route::post('/admin/coupons', 'App\Http\Controllers\Admin\AdminCouponController@store')->name('admin.coupons.store'); // Guardar cupón
    Route::get('/admin/coupons/{id}/edit', 'App\Http\Controllers\Admin\AdminCouponController@edit')->name('admin.coupons.edit'); // Editar cupón
    Route::put('/admin/coupons/{id}', 'App\Http\Controllers\Admin\AdminCouponController@update')->name('admin.coupons.update'); // Actualizar cupón
    Route::delete('/admin/coupons/{id}', 'App\Http\Controllers\Admin\AdminCouponController@destroy')->name('admin.coupons.destroy'); // Eliminar cupón
});

Auth::routes();
