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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//authentication
// Route::get('manage-product','Backend\ProductController@index');
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logoutt');
Route::post('login', 'Auth\LoginController@authenticate')->name('loginn');

//socilite
//facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
//google
Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');

//backend

// ckeditor upload image
Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');

//filter
Route::get('manage-product/search','Backend\ProductController@filter')->name('filter');
Route::get('manage-quotation/search','Backend\QuotationController@filter')->name('qfilter');
Route::get('filter-orders', 'Backend\OrderController@filter')->name('filter-orders');
Route::get('manage-code/search', 'Backend\CodeController@filter')->name('filter-code');
Route::get('manage-post/search', 'Backend\PostController@filter')->name('filter-post');
Route::get('manage-promotion/search','Backend\PromotionController@filter')->name('filter-promotion');

Route::get('manage-comments', 'Backend\CommentController@post_comment')->name('manage-comments');
Route::get('filter-user', 'Backend\UserController@filter')->name('filter-user');
Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::resources([
    'manage-user' => 'Backend\UserController',
    'manage-product-category' => 'Backend\ProductCategoryController',
    'manage-product' => 'Backend\ProductController',
    'manage-post-category' => 'Backend\PostCategoryController',
    'manage-post' => 'Backend\PostController',
    'manage-tag' => 'Backend\TagController',
    'manage-banner' => 'Backend\BannerController',
    'manage-code' => 'Backend\CodeController',
    'manage-order' => 'Backend\OrderController',
    'manage-quotation' => 'Backend\QuotationController',
    'manage-footer-post' => 'Backend\FooterPostController',
    'manage-comment' => 'Backend\CommentController',
    'manage-file' => 'Backend\FileController',
    'manage-promotion'=> 'Backend\PromotionController'
]);


//frontend
Route::get('','Frontend\HomeController@index')->name('index');
Route::get('index','Frontend\HomeController@index');

Route::get('search', 'Frontend\HomeController@search')->name('search-product');
Route::post('filter-search', 'Frontend\HomeController@filterSearch')->name('filter-search');

Route::get('danh-muc/{id}','Frontend\ProductCategoryController@show')->name('danh-muc');
Route::get('filter-product-cate/{id}', 'Frontend\ProductCategoryController@filter')->name('filter-product-cate');
Route::get('san-pham/{id}', 'Frontend\ProductController@show')->name('detail-product');

Route::resource('post','Frontend\PostController');
Route::resource('cart','Backend\CartController');
Route::resource('order','Backend\OrderDetailController');
Route::resource('user','Frontend\UserController');
Route::resource('don-hang','Frontend\OrderController');
Route::resource('address','Backend\AddressController');
Route::resource('code','Frontend\CodeController');
Route::resource('manage-address','Frontend\AddressController');
Route::resource('footer-post','Frontend\FooterPostController');
Route::resource('tag','Frontend\TagController');

//quotation 
Route::resource('yeu-cau-bao-gia','Frontend\QuotationController');

Route::get('dia-chi','Backend\AddressController@create');
Route::get('tao-dia-chi','Backend\AddressController@createAddress');
Route::post('save-address','Backend\AddressController@storeAddressOnly');

Route::get('filter-order', 'Frontend\OrderController@filter')->name('filter-order');

//comments for post
Route::post('comments', 'Frontend\CommentController@store')->name('comment');

Route::post('comment-product', 'Frontend\CommentController@product')->name('comment-product');

Route::get('check-cart', 'Frontend\CheckcartController@index')->name('check-cart');
Route::get('list-cart', 'Frontend\CheckcartController@show')->name('list-cart');

Route::post('reply', 'Frontend\ReplyController@store')->name('reply');

Route::post('saving-data','Backend\AddressController@store');
Route::post('saving-order','Backend\AddressController@save');
Route::get('thanh-toan','Backend\AddressController@index');
Route::get('get-district-list','Backend\AddressController@getDistrictList');
Route::get('get-ward-list','Backend\AddressController@getWardList');

//change user password by themselve
Route::post('update-password','Frontend\UserController@updatePassword')->name('update-password');

//export data user 
Route::get('export', 'Backend\ExportController@export')->name('export');
Route::get('export-order', 'Backend\ExportOrderController@export')->name('export-order');
Route::get('export-product', 'Backend\ExportProductController@export')->name('export-product');
Route::get('export-code', 'Backend\ExportCodeController@export')->name('export-code');