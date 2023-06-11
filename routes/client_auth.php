<?php

use App\Http\Controllers\Auth\Client\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Client\ConfirmablePasswordController;
use App\Http\Controllers\Auth\Client\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\Client\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Client\NewPasswordController;
use App\Http\Controllers\Auth\Client\PasswordController;
use App\Http\Controllers\Auth\Client\PasswordResetLinkController;
use App\Http\Controllers\Auth\Client\RegisteredUserController;
use App\Http\Controllers\Auth\Client\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:client')->name('client.')->group(function () {
    Route::get('/client/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('/client/register', [RegisteredUserController::class, 'store']);

    Route::get('/client/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('/client/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/client/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('/client/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('/client/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('/client/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:client')->name('client.')->group(function () {
    Route::get('/client/verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('/client/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('/client/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('/client/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('/client/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('/client/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('/client/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
