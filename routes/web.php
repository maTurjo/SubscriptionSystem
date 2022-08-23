<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewController;
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

// Route::get('/homepage',[ViewController::class,"toHomepage"]);

Route::get('/',[ViewController::class,"toHomepage"])
->middleware("IsSubscriber");

Route::post('/registerProduct',[SubscriptionController::class,"registerProduct"]);

Route::get('/customerLogin',[CustomerController::class,"customerLogin"]);
Route::post('/customerLogin',[CustomerController::class,"getCustomerLoggedIn"]);
Route::get('/logout',[CustomerController::class,"logout"]);

Route::get('/customerRegistration',[CustomerController::class,"customerRegistration"]);
Route::post('/customerRegistration',[CustomerController::class,"getCustomerRegistered"]);

Route::post('/payment',[PaymentController::class,"index"])
->middleware("IsSubscriber");

//Admin Routes

Route::get('/admin',[AdminController::class,"index"])
->middleware('IsAdmin');

Route::get('/addProductLicense-admin',[AdminController::class,"addProductLicense"])
->middleware('IsSubscriber','IsAdmin');


Route::post('/addProductLicense-admin',[AdminController::class,"generateProductLicense"])
->middleware('IsSubscriber','IsAdmin');

Route::get('/addProduct-admin',[AdminController::class,"addProduct"])
->middleware('IsSubscriber','IsAdmin');

Route::post('/addProduct-admin',[AdminController::class,"addNewProductType"])
->middleware('IsSubscriber','IsAdmin');

