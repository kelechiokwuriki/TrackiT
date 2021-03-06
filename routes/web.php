<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\MySessionController;
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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/mysessions', 'SessionsController@mysessions');
    Route::get('/onerepmaxcalculator', 'OneRepMaxController@calculateOneRepMax');
    Route::resource('sessions', 'SessionsController');
    Route::get('/file/{sessionslug}', 'FileController@generatePdfFile');
});

