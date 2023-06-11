<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::middleware('auth:client')->prefix('review')->name('client.review.')->group(function() {
        Route::get('/', 'ReviewController@index')->name('index');//handeled by livewire
        Route::get('/create', 'ReviewController@create')->name('create');
        Route::post('/store', 'ReviewController@store')->name('store');
        Route::get('/edit/{id}', 'ReviewController@edit')->name('edit');
        Route::post('/update', 'ReviewController@update')->name('update');
        Route::post('/delete', 'ReviewController@destroy')->name('destroy');
    });

    Route::middleware('auth:coach')->prefix('coach/review')->name('coach.review.')->group(function() {
        Route::get('/', 'ReviewController@index')->name('index');//handeled by livewire
        Route::get('/show/{id}', 'ReviewController@show')->name('show');
    });


    Route::middleware('auth:admin')->prefix('admin/review')->name('admin.review.')->group(function() {
        Route::get('/', 'ReviewController@index')->name('index');//handeled by livewire
        Route::post('/delete', 'ReviewController@destroy')->name('destroy');
    });

});