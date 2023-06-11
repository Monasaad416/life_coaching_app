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
    Route::middleware('auth:coach')->prefix('appointment')->name('coach.appointment.')->group(function() {
        Route::get('/', 'AppointmentController@index')->name('index');
        Route::get('/create', 'AppointmentController@create')->name('create');
        Route::post('/store', 'AppointmentController@store')->name('store');
        Route::get('/create', 'AppointmentController@create')->name('create');
        Route::post('/store', 'AppointmentController@store')->name('store');
        Route::get('/edit/{id}', 'AppointmentController@edit')->name('edit');
        Route::post('/update', 'AppointmentController@update')->name('update');
        Route::post('/delete', 'AppointmentController@destroy')->name('destroy');

    });






    Route::middleware('auth:admin')->prefix('appointment')->name('admin.appointment.')->group(function() {
        Route::get('/admin', 'AppointmentController@index')->name('index');
        Route::get('/filtered-appointments', 'AppointmentController@searchByCoach')->name('filtered.appointments');
    });




});
