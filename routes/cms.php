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

use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::any('/login', 'AuthController@login')->name('cms.auth.login');
Route::any('/logout', 'AuthController@logout')->name('cms.auth.logout');

Route::group(['middleware' => ['auth', 'checkPermission']], function () {
    /*Home*/
    Route::get('/', function () {
        return view('cms.layout.index');
    })->name('dashboard');
    Route::any('/change-password', 'AuthController@changePassword')->name('cms.auth.changePassword');

    /*post*/
    Route::get('/post', 'PostController@index')->name('cms.post.list');
    Route::any('/post/add', 'PostController@add')->name('cms.post.add');
    Route::any('/post/update/{id}', 'PostController@update')->where(['id' => '[0-9]+'])->name('cms.post.update');
    Route::any('/post/delete/{id}', 'PostController@delete')->where(['id' => '[0-9]+'])->name('cms.post.delete');
    Route::any('/post/change-status/{id}/{status}', 'PostController@changeStatus')->where(['id' => '[0-9]+', 'status' => '[01]'])->name('cms.post.changeStatus');
    
    /*product*/
    Route::get('/product', 'ProductController@index')->name('cms.product.list');
    Route::any('/product/add', 'ProductController@add')->name('cms.product.add');
    Route::any('/product/update/{id}', 'ProductController@update')->where(['id' => '[0-9]+'])->name('cms.product.update');
    Route::any('/product/delete/{id}', 'ProductController@delete')->where(['id' => '[0-9]+'])->name('cms.product.delete');
    Route::any('/product/change-status/{id}/{status}', 'ProductController@changeStatus')->where(['id' => '[0-9]+', 'status' => '[01]'])->name('cms.product.changeStatus');

    /*order*/
    Route::get('/order', 'OrderController@index')->name('cms.order.list');
    Route::any('/order/{code}', 'OrderController@detail')->where(['code' => '[A-Z0-9]+'])->name('cms.order.detail');
    Route::any('/order/change-status/{id}', 'OrderController@changeStatus')->where(['id' => '[0-9]+'])->name('cms.order.changeStatus');
    Route::any('/order/cancel/{id}', 'OrderController@cancel')->where(['id' => '[0-9]+'])->name('cms.order.cancel');


    /*Category*/
    Route::get('/category', 'CategoryController@index')->name('cms.category.list');
    Route::any('/category/add', 'CategoryController@add')->name('cms.category.add');
    Route::any('/category/update/{id}', 'CategoryController@update')->where(['id' => '[0-9]+'])->name('cms.category.update');
    Route::any('/category/delete/{id}', 'CategoryController@delete')->where(['id' => '[0-9]+'])->name('cms.category.delete');
    Route::any('/category/change-status/{id}/{status}', 'CategoryController@changeStatus')->where(['id' => '[0-9]+', 'status' => '[01]'])->name('cms.category.changeStatus');

    /*supplier*/
    Route::get('/supplier', 'SupplierController@index')->name('cms.supplier.list');
    Route::any('/supplier/add', 'SupplierController@add')->name('cms.supplier.add');
    Route::any('/supplier/update/{id}', 'SupplierController@update')->where(['id' => '[0-9]+'])->name('cms.supplier.update');
    Route::any('/supplier/delete/{id}', 'SupplierController@delete')->where(['id' => '[0-9]+'])->name('cms.supplier.delete');
    Route::any('/supplier/change-status/{id}/{status}', 'SupplierController@changeStatus')->where(['id' => '[0-9]+', 'status' => '[01]'])->name('cms.supplier.changeStatus');

    /*User*/
    Route::get('/profile', 'ProfileController@index')->name('cms.profile.list');
    Route::any('/profile/add', 'ProfileController@add')->name('cms.profile.add');
    Route::any('/profile/update/{id}', 'ProfileController@update')->where(['id' => '[0-9]+'])->name('cms.profile.update');
    Route::any('/profile/detail/{id}', 'ProfileController@detail')->where(['id' => '[0-9]+'])->name('cms.profile.detail');

    /*User*/
    Route::get('/user', 'UserController@index')->name('cms.user.list');
    Route::any('/user/add', 'UserController@add')->name('cms.user.add');
    Route::any('/user/update/{id}', 'UserController@update')->where(['id' => '[0-9]+'])->name('cms.user.update');
    Route::any('/user/delete/{id}', 'UserController@delete')->where(['id' => '[0-9]+'])->name('cms.user.delete');
    Route::any('/user/change-status/{id}/{status}', 'UserController@changeStatus')->where(['id' => '[0-9]+', 'status' => '[01]'])->name('cms.user.changeStatus');

    /*Menu*/
    Route::get('/menu', 'MenuController@index')->name('cms.menu.index');
    Route::post('/menu/add', 'MenuController@add')->name('cms.menu.add');
    Route::any('/menu/update/{id}', 'MenuController@update')->where(['id' => '[0-9]+'])->name('cms.menu.update');
    Route::get('/menu/delete/{id}', 'MenuController@delete')->where(['id' => '[0-9]+'])->name('cms.menu.delete');
    Route::get('/menu/up/{id}', 'MenuController@up')->where(['id' => '[0-9]+'])->name('cms.menu.up');

    /*report*/
    Route::get('/report', 'ReportController@index')->name('cms.report');


    Route::group(['prefix' => 'laravel-filemanager'], function () {
        Lfm::routes();
    });

    Route::get('/media', function () {
        return view('cms.media.index');
    })->name('cms.media');
    // ajax
    Route::get('/category/loadAjax', 'CategoryController@loadAjax')->name('cms.category.loadAjax');
});
