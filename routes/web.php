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

//restaurant - front
Route::get('/restaurants','FrontendController@showRestaurants');
Route::get('/restaurants/{id}','FrontendController@showSingleRestaurant');
Route::get('/restaurant/{idRestaurant}/category/{idCategory}','FrontendController@showProductsCategory');
Route::get('/restaurants/kitchen/{id}','FrontendController@showKitchenRestaurant');

//jobs
Route::get('/jobs','FrontendController@showJobs');
Route::get('/jobs/{id}','FrontendController@showSingleJob');
Route::get('/application/{id}','FrontendController@addApplicant')->middleware('user');

//signin
Route::get('/registration','UserController@showRegistrationForm');
Route::post('/registration','UserController@register');

//restaurant as user
Route::get('/restaurant/registration', 'UserController@showRegisterRestaurantForm');
Route::post('/restaurant/registration', 'UserController@registerRestaurant');
Route::get('/login-restaurant', 'UserController@showRestaurantLoginForm');
Route::post('/login-restaurant', 'UserController@restaurantLogin');
Route::group(['middleware' => 'restaurant'], function() {
    Route::get('/restaurant/logout', function () {
        session()->forget('restaurant');
        return redirect('/login-restaurant');
    });
//restaurant panel
    Route::get('/restaurant-profile', 'RestaurantController@showRestaurantIndex');
    Route::get('/restaurant/comments', 'RestaurantController@showRestaurantComments');
    Route::get('/restaurant/jobs', 'RestaurantController@showRestaurantJobs');
    Route::get('/restaurant/applicants', 'RestaurantController@showRestaurantApplicants');
    Route::get('/restaurant/job/applicants/{id}', 'RestaurantController@showRestaurantJobApplicants');
    Route::get('/restaurant/orders', 'RestaurantController@showOrders');
//restaurant insert
    Route::get('/restaurant/insert-product', 'RestaurantController@showInsertProductForm');
    Route::post('/restaurant/insert-product', 'RestaurantController@insertProduct');
    Route::get('/restaurant/insert-job', 'RestaurantController@showInsertJobForm');
    Route::post('/restaurant/insert-job', 'RestaurantController@insertJob');
//Restaurant update
    Route::get('/restaurant/update-product', 'RestaurantController@showUpdateProductTable');
    Route::get('/restaurant/update-product/{id}', 'RestaurantController@showUpdateProductForm');
    Route::post('/restaurant/final-update-product/{id}', 'RestaurantController@updateProduct');
//Restaurant delete
    Route::get('/restaurant/delete-product', 'RestaurantController@showDeleteProductForm');
    Route::get('/restaurant/delete-product/{id}', 'RestaurantController@deleteProduct');
    Route::get('/restaurant/delete-job', 'RestaurantController@showDeleteJobForm');
    Route::get('/restaurant/delete-job/{id}', 'RestaurantController@deleteJob');


    Route::get('/restaurant/update-job-info', 'RestaurantController@showUpdateJobTable');
    Route::get('/restaurant/update-job-info/{id}', 'RestaurantController@showUpdateJobForm');
    Route::post('/restaurant/final-update-job/{id}', 'RestaurantController@updateJob');

    Route::get('/restaurant/update', 'RestaurantController@showInfoUpdateForm');
    Route::post('/restaurant/update', 'RestaurantController@updateInfo');
});

//user
Route::get('/login','UserController@showLoginForm');
Route::post('/login','UserController@login');
Route::group(['middleware' => 'user'], function (){
    Route::get('/logout', function () {
        session()->forget('user');
        session()->forget('cart');
        return redirect('/login');
    });
    Route::get('/user-profile', 'UserController@showUserProfile');
    Route::get('/user-orders', 'UserController@showUserOrders');
    Route::get('/user-liked-restaurants', 'UserController@showUserLikedRestaurants');
    Route::get('/user-jobs', 'UserController@showAppliedJobs');
//cart
    Route::get('/add-to-cart/{id}','CartController@addToCart');
    Route::get('/cart','CartController@getCart');
    Route::get('/reduce/{id}', 'CartController@reduceByOne');
    Route::get('/removeAll/{id}', 'CartController@removeAll');

    Route::get('/checkout', 'CartController@getCheckout');
    Route::post('/post-checkout', 'CartController@placeOrder');
//likes
    Route::get('/likes/{id}', 'FrontendController@addLike');

//comments
    Route::post('/comment/add/{id}','UserController@addComment');
});


//admin
Route::group(['middleware' => 'admin'], function (){
    Route::get('/admin/logout', function () {
        session()->forget('user');
        session()->forget('cart');
        return redirect('/login');
    });

    Route::get('/admin','AdminController@adminIndex');

//admin insert
    Route::get('/admin/insert-category', 'AdminController@showInsertCategoryForm');
    Route::post('/admin/insert-category', 'AdminController@addCategory');

    Route::get('/admin/add-link', 'AdminController@showInsertLinkForm');
    Route::post('/admin/insert-link', 'AdminController@addLink');

    Route::get('/admin/insert-slider', 'AdminController@showInsertSliderForm');
    Route::post('/admin/insert-slider', 'AdminController@addSlider');

    Route::get('/admin/add-kitchen', 'AdminController@showInsertKitchenForm');
    Route::post('/admin/add-kitchen', 'AdminController@addKitchen');

//delete
    Route::get('/admin/delete-slider', 'AdminController@showDeleteSliderForm');
    Route::get('/admin/delete-slider/{id}', 'AdminController@deleteSlider');
    Route::get('/admin/delete-comment', 'AdminController@showDeleteCommentForm');
    Route::get('/admin/delete-comment/{id}', 'AdminController@deleteComment');
    Route::get('/admin/delete-link', 'AdminController@showDeleteLinkForm');
    Route::get('/admin/delete-link/{id}', 'AdminController@deleteLink');
    Route::get('/admin/delete-kitchen', 'AdminController@showDeleteKitchenForm');
    Route::get('/admin/delete-kitchen/{id}', 'AdminController@deleteKitchen');
});









