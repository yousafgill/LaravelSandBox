<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

Route::get('buy/{cookies}', function ($cookies) {
    try {
        \DB::statement("ALTER TABLE users ADD COLUMN EXISTS wallet int(11) null DEFAULT 10");
    } catch (\Throwable $e) {
        # code...
    }
    $user = \Auth::user();
    $wallet = $user->wallet; 
    if($wallet >=$cookies){
       
        $balance  =  (($wallet - $cookies) * 1);
        \DB::statement("update `users` set wallet = $balance where id =".Auth::id());
        Log::info('User ' . $user->email . ' have bought ' . $cookies . ' cookies'); // we need to log who ordered and how much
        return 'Success, you have bought ' . $cookies . ' cookies!';  
    }else{
        Log::warning('User ' . $user->email . ' attempted to buy ' . $cookies . ' cookies'); //
        return 'Sorry, you can\'t buy ' . $cookies . ' cookies! due to low balance';  
        
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Employees Route
Route::get('/employees/index','EmployeeController@index')->name('index');
Route::get('/employees/create','EmployeeController@create')->name('create');
Route::post('/employees/createsave','EmployeeController@createsave')->name('createsave');

Route::get('/invoices/getjson','InvoiceController@getjson')->name('getjson');

