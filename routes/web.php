<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

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
Route::get('/register','App\Http\Controllers\UserController@register');
Route::get('/login','App\Http\Controllers\UserController@login');
Route::post('/register','App\Http\Controllers\UserController@signUp');
Route::post('/login','App\Http\Controllers\UserController@signIn');
Route::get('/logout','App\Http\Controllers\UserController@logout');
Route::get('/download/{source}','App\Http\Controllers\MainController@getDownload');
Route::post('/buy/{user}/{course}','App\Http\Controllers\CourseController@buy');
Route::get('/account','App\Http\Controllers\UserController@account');
Route::get('/account/edit','App\Http\Controllers\UserController@editByUser');
Route::get('/account/edit-password','App\Http\Controllers\UserController@editPassword');
Route::put('/account','App\Http\Controllers\UserController@updatePassword');
Route::put('/account/edit','App\Http\Controllers\UserController@updateByUser');


Route::middleware(['UserCheck'])->prefix('/admin')->group(function (){
    Route::get('/',function (){
        return \view('admin.dash-board')->with('user',Auth::user());
    });
    Route::group(['middleware' => 'AdminCheck'],function (){
        Route::get('/category','App\Http\Controllers\LearnController@index');
        Route::post('/category','App\Http\Controllers\LearnController@save');
        Route::get('/category/{category}/edit','App\Http\Controllers\LearnController@edit');
        Route::put('/category/{category}','App\Http\Controllers\learnController@update');
        Route::delete('/category/{category}','App\Http\Controllers\LearnController@destroy');
        Route::get('/category/create','App\Http\Controllers\LearnController@create');



        Route::get('/user','App\Http\Controllers\UserController@index');
        Route::get('/user/{user}/edit','App\Http\Controllers\UserController@edit');
        Route::put('/user/{user}','App\Http\Controllers\UserController@update');
        Route::delete('/user/{user}','App\Http\Controllers\UserController@destroy');
    });






    Route::get('/course','App\Http\Controllers\CourseController@index');
    Route::get('/course/create','App\Http\Controllers\CourseController@create');
    Route::get('/course/{course}/display','App\Http\Controllers\CourseController@display');
    Route::get('/course/{course}/edit','App\Http\Controllers\CourseController@edit');
    Route::put('/course/{course}','App\Http\Controllers\CourseController@update');
    Route::post('/course','App\Http\Controllers\CourseController@save');
    Route::delete('/course/{course}','App\Http\Controllers\CourseController@destroy');


    Route::get('/course/{course}/video','App\Http\Controllers\VideoController@index');
    Route::get('/course/{course}/video/create','App\Http\Controllers\VideoController@create');
    Route::get('/video/{video}/display','App\Http\Controllers\VideoController@display');
    Route::post('/video','App\Http\Controllers\VideoController@save');
    Route::put('/video/{video}','App\Http\Controllers\VideoController@update');
    Route::get('/course/{course}/video/{video}/edit','App\Http\Controllers\VideoController@edit');
    Route::delete('/video/{video}','App\Http\Controllers\VideoController@destroy');
});
