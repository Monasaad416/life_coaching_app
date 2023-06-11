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
    Route::middleware('auth:admin')->prefix('category')->name('admin.category.')->group(function() {
        Route::get('/', 'AdminCategoryController@index')->name('index');//handeled by livewire
        Route::get('/create', 'AdminCategoryController@create')->name('create');
        Route::post('/store', 'AdminCategoryController@store')->name('store');
        Route::get('/create', 'AdminCategoryController@create')->name('create');
        Route::post('/store', 'AdminCategoryController@store')->name('store');
        Route::get('/edit/{id}', 'AdminCategoryController@edit')->name('edit');
        Route::post('/update', 'AdminCategoryController@update')->name('update');
        Route::post('/delete', 'AdminCategoryController@destroy')->name('destroy');
        

    });

    Route::middleware('auth:coach')->prefix('coach/category')->name('coach.category.')->group(function() {
        Route::get('/', 'AdminCategoryController@index')->name('index');//handeled by livewire
    });


    Route::middleware('auth:client')->prefix('client/category')->name('client.category.')->group(function() {
        Route::get('/', 'AdminCategoryController@index')->name('index');//handeled by livewire
    });

});


