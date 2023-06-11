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


        Route::middleware('auth:coach')->prefix('service/coach')->name('coach.service.')->group(function() {
            Route::get('/', 'ServiceController@index')->name('index');//handeled by livewire
            Route::get('/create', 'ServiceController@create')->name('create');
            Route::post('/store', 'ServiceController@store')->name('store');
            Route::get('/edit/{id}', 'ServiceController@edit')->name('edit');
            Route::get('/show/{id}', 'ServiceController@show')->name('show');
            Route::post('/update', 'ServiceController@update')->name('update');
            Route::post('/delete', 'ServiceController@destroy')->name('destroy');
        });

        Route::middleware('auth:admin')->prefix('service/admin')->name('admin.service.')->group(function() {
            Route::get('/', 'ServiceController@index')->name('index');//handeled by livewire
            Route::get('/show/{id}', 'ServiceController@show')->name('show');
            Route::post('/delete', 'ServiceController@destroy')->name('destroy');
        });


});
