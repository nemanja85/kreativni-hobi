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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
// Admin Interface Routes
Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
	Route::get('create', 'Admin\AdminController@create')->name('create');
	Route::post('show', 'Admin\AdminController@show')->name('show');
	Route::post('subcat', 'Admin\AdminController@getSubcat')->name('subcat');
	Route::post('updateStatus', 'Admin\AdminController@updateStatus');
});

Route::get('home', 'HomeController@index')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('gift', 'HomeController@gift')->name('gift');
Route::get('inspiration', 'BlogController@inspiration')->name('inspiration');
Route::post('blog', 'BlogController@get_inspiration');

Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('novo', 'HomeController@new')->name('novo');
Route::get('profil', 'UserProfil@profil')->name('profil');
//Route::get('/uslovi-koriscenja', 'HomeController@terms')->name('uslovi');
Route::get('politika-privatnosti', 'HomeController@private_policy')->name('politika');
Route::get('opsti-uslovi-slanja-robe', 'HomeController@delivery_terms')->name('opšti-uslovi');

Route::get('/placanje/{basketToken}', 'CartController@payment');
Route::post('/placanje/basketToken', 'CartController@payment')->name('direct');
Route::post('placanje', 'CartController@unpaid')->name('unpaid');
Route::get('/korpa/{basketToken}', 'CartController@basket');
//Route::get('/zamena-proizvoda', 'HomeController@exchange')->name('zamena');

Route::get('proizvodi', 'CategoryController@categories')->name('proizvodi');
Route::post('category/subcategory', 'CategoryController@getSubcat');
Route::post('category/subcategory/products', 'CategoryController@allProducts');
Route::post('action-show', 'CategoryController@action')->name('show');
Route::post('item/delete', 'CartController@deleteFromBasket');

Route::get('proizvodi/{category_id}/{category_name}', 'CategoryController@getSubCategories');
Route::get('proizvodi/{category_id}/kategorija/{item_id}/{item_slug}', 'CategoryController@singleNoSubProduct');
Route::get('proizvodi/{category_id}/{category_name}/{subcategory_id}/{subcategory_name}', 'CategoryController@getSubcatHtml');

Route::get('proizvodi/{category_id}/{category_name}/{subcategory_id}/{subcategory_name}/{item_id}/{item_slug}', 'CategoryController@singleProduct')->name('proizvod');
Route::post('item', 'CartController@addToBasket');
Route::get('placanje/{id}/{basketToken}', 'CartController@direct');
Route::post('increase', 'CartController@increment');
Route::post('decrease', 'CartController@decrement');

Route::post('aik3D', 'CartController@aikBank')->name('aik3D');
Route::post('3DSuccessResult', 'CartController@aikSuccess');
Route::post('3DFailResult', 'CartController@aikFail');
Route::get('/send', 'EmailController@send');
Route::post('send-order', 'CartController@sendOrder');