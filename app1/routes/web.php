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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Employees Route
Route::get('/employees/index','EmployeeController@index')->name('index');
Route::get('/employees/create','EmployeeController@create')->name('create');
Route::post('/employees/createsave','EmployeeController@createsave')->name('createsave');

Route::get('/invoices/getjson','InvoiceController@getjson')->name('getjson');