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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/setup/migrations', 'App\Http\Controllers\SetupController@migrations')->name('setup.migrations');
Route::get('/setup/dosymlink', 'App\Http\Controllers\SetupController@dosymlink')->name('setup.dosymlink');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','App\Http\Controllers\RoleController');
    Route::resource('users','App\Http\Controllers\UserController');
});



Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');
Route::get('facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook', 'App\Http\Controllers\Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'App\Http\Controllers\Auth\FacebookController@handleFacebookCallback');