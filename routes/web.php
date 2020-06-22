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

Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/products/create', 'ProductController@create')->name('product.create');
Route::get('/products/{product}', 'ProductController@show')->name('product.show');
Route::post('/products', 'ProductController@store')->name('product.store');
