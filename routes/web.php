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

Route::get('/', 'App\Http\Controllers\MainController@index');
Route::get('/search','App\Http\Controllers\MainController@search');
Route::get('/learn/{slug1?}/{slug2?}','App\Http\Controllers\LearnController@show');
Route::get('/course/{slug1}/{slug2?}','App\Http\Controllers\CourseController@show');
