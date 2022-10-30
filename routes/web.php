<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\WebMiddleware;
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



Route::middleware([WebMiddleware::class])->group(function () {
	Route::get('/', 'HomeController@index')->name('web.home');

	Route::any('/login', 'AuthController@login')->name('web.login');
	Route::any('/logout', 'AuthController@logout')->name('web.logout');
	Route::any('/register', 'AuthController@register')->name('web.register');
	Route::any('/edit-profile', 'AuthController@profile')->name('web.profile');
	Route::any('/change-password', 'AuthController@changePassword')->name('web.change-password');
	Route::any('/update-profile', 'AuthController@updateProfile')->name('web.update-profile');

	Route::any('/history', 'OrderController@history')->name('web.order.history');
	Route::any('/order/{code}', 'OrderController@detail')->where(['code' => '[A-Z0-9]+'])->name('web.order.detail');
	

	Route::post('/order/add', 'OrderController@add')->name('web.order.add');

	Route::get('/cart', 'CartController@index')->name('web.cart');
	Route::post('/cart/add', 'CartController@add')->name('web.cart.add');
	Route::post('/cart/minus', 'CartController@minus')->name('web.cart.minus');
	Route::get('/cart/delete/{product_id}', 'CartController@delete')->where(['product_id' => '[0-9]+'])->name('web.cart.delete');

	Route::get('/search', 'ProductController@search')->name('web.product.search');

	Route::get('/nha-cung-cap/{slug}', 'SupplierController@detail')->where(['slug' => '[\s\S]+'])->name('web.supplier.detail');

	Route::get('/{category_slug}/{slug}', 'ProductController@detail')->where(['slug' => '[\s\S]+', 'category_slug' => '[\s\S]+'])->name('web.product.detail');

	Route::get('/{slug}.html', 'PostController@detail')->where(['slug' => '[\s\S]+'])->name('web.post.detail');

	Route::get('/{slug}', 'CategoryController@detail')->where(['slug' => '[\s\S]+'])->name('web.category.detail');
});
