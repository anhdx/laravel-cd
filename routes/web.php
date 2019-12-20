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
Route::get('/login','PageController@getLogin')->name('login');
Route::get('/register','PageController@getRegister')->name('register');
Route::post('/login','PageController@postLogin')->middleware('isAdmin','isMember')->name('postLogin');
Route::post('/register','PageController@postRegister')->name('postRegister');
Route::get('/','PageController@index');
Route::get('/home','PageController@index')->name('home');
Route::get('/category','PageController@category')->name('category');
Route::get('/contacts','PageController@contact')->name('contact');
Route::post('/contacts','PageController@postContact')->name('client.contact');
Route::get('/about','PageController@aboutUs')->name('about');
Route::get('/category/{id}','PageController@getCategory')->name('cates');
Route::get('/product/detail/{id}','PageController@detail')->name('detail');
Route::get('/add-cart/{id}','PageController@addCart')->name('addToCart');
Route::get('/removeCart/{id}','PageController@removeCart')->name('removeCart');
Route::get('/order','PageController@order')->name('order');
Route::post('/order','PageController@checkOut')->name('postOrder');
Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
	Route::get('/home',function(){
		return view('user.home');
	})->name('login.view');
	Route::get('/logout','PageController@destroy')->name('logout');
});
Route::get('/search','PageController@search')->name('search');

Route::group(['prefix'=>'admin','as'=>'admin','middleware'=>'checkAuth'],function(){
	Route::get('/','admin\UserController@index');


});