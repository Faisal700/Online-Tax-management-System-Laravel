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



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('profile','ProfileController');
Route::resource('citizens','CitizenController');
Route::resource('departments','DepartmentController');
Route::resource('basic_units','BasicUnitController');
Route::get('payments/all','PaymentController@Allpayment');
Route::get('payments/confirm/{id}','PaymentController@Confirmpayment');
Route::get('payments/cancel/{id}','PaymentController@Cancelpayment');
Route::resource('payments','PaymentController');
Route::get('complains/all','ComplainController@AllComplain');
Route::post('complains/response/{id}','ComplainController@Response');
Route::resource('complains','ComplainController');
Route::get('tax_scale','BasicUnitController@TaxScale');
Route::get('tax_calculate','BasicUnitController@taxCalculate');
Route::get('tax_report','BasicUnitController@taxReport');
Route::get('properties/all','PropertyController@AllProperty');
Route::resource('properties','PropertyController');