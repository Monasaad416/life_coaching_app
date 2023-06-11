<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ClientProfileController;
use App\Http\Controllers\Admin\CoachProfileController;
use App\Http\Controllers\Admin\RoleController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::get('/selection', [HomeController::class,'selection'])->name('selection');

    Route::get('/admin/dashboard', [HomeController::class,'adminIndex'])->name('admin.index');
    Route::get('/client/dashboard', [HomeController::class,'clientIndex'])->name('client.index');
    Route::get('/coach/dashboard', [HomeController::class,'coachIndex'])->name('coach.index');

    //edit profiles
    Route::get('/admin/edit-profile', [AdminProfileController::class,'editProfile'])->name('admin.edit_profile');
    Route::post('/admin/update-profile', [AdminProfileController::class,'updateProfile'])->name('admin.update_profile');

    Route::group(['prefix' => '/admin' , 'as' => 'admin.'],function(){
        Route::resource('roles' , RoleController::class);
    });






    Route::get('/client/edit-profile', [ClientProfileController::class,'editProfile'])->name('client.edit_profile');
    Route::post('/client/update-profile', [ClientProfileController::class,'updateProfile'])->name('client.update_profile');

    Route::get('/coach/edit-profile', [CoachProfileController::class,'editProfile'])->name('coach.edit_profile');
    Route::post('/coach/update-profile', [CoachProfileController::class,'updateProfile'])->name('coach.update_profile');
    Route::get('/coach/certificates', [CoachProfileController::class,'certificates'])->name('coach.certificates');
    Route::post('/coach/add-certificate', [CoachProfileController::class,'addCertificate'])->name('coach.add_certificate');
    Route::post('/coach/delete-certificate', [CoachProfileController::class,'deleteCertificate'])->name('coach.delete_certificate');



    require __DIR__.'/admin_auth.php';
    require __DIR__.'/client_auth.php';
    require __DIR__.'/coach_auth.php';


});







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


