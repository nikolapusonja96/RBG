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


Route::get('/','FrontendController@showHome');
Route::get('/author','FrontendController@showAuthor');
Route::get('/about','FrontendController@showAbout');
Route::get('/contact','MailController@showContactForm');

//mail
Route::post('/contact/sendmail', 'MailController@sendMail');

//restaurant
Route::get('/restaurants','FrontendController@showRestaurants');
Route::get('/restaurants/{id}','FrontendController@showSingleRestaurant');
Route::get('/restaurant/{idRestaurant}/category/{idCategory}','FrontendController@showProductsCategory');
Route::get('/restaurants/kitchen/{id}','FrontendController@showKitchenRestaurant');

//jobs
Route::get('/jobs','FrontendController@showJobs');
Route::get('/jobs/{id}','FrontendController@showSingleJob');
Route::get('/application/{id}','FrontendController@addApplicant');

//signin
Route::get('/registration','UserController@showRegistrationForm');
Route::post('/registration','UserController@register');

Route::get('/restaurant/registration', 'UserController@showRegisterRestaurantForm');
Route::post('/restaurant/registration', 'UserController@registerRestaurant');

//login
Route::get('/login','UserController@showLoginForm');
Route::post('/login','UserController@login');
Route::get('/logout', function(){
    session()->forget('user');
    return redirect('/login');
});

//cart

Route::get('/add-to-cart/{id}','CartController@addToCart');
Route::get('/cart','CartController@getCart');

Route::get('/reduce/{id}', 'CartController@reduceByOne');
Route::get('/removeAll/{id}', 'CartController@removeAll');

Route::get('/checkout', 'CartController@getCheckout');
Route::post('/postCheckout', 'CartController@placeOrder');

//likes

Route::get('/likes/{id}', 'FrontendController@addLike');
















