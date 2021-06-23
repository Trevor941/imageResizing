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
Route::get('index', 'App\Http\Controllers\ImageController@index');
Route::get('/staff', 'App\Http\Controllers\ImageController@staffImages');
Route::get('/products', 'App\Http\Controllers\ImageController@productsImages');
Route::post('/imageresize', 'App\Http\Controllers\ImageController@resizeStaffImages');
Route::post('/resizeProductsImages', 'App\Http\Controllers\ImageController@resizeProductsImages');