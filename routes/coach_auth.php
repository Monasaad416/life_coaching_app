<?php

use App\Http\Controllers\Auth\Coach\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Coach\ConfirmablePasswordController;
use App\Http\Controllers\Auth\Coach\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\Coach\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Coach\NewPasswordController;
use App\Http\Controllers\Auth\Coach\PasswordController;
use App\Http\Controllers\Auth\Coach\PasswordResetLinkController;
use App\Http\Controllers\Auth\Coach\RegisteredUserController;
use App\Http\Controllers\Auth\Coach\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:coach')->name('coach.')->group(function () {
    Route::get('coach/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('coach/register', [RegisteredUserController::class, 'store']);

    Route::get('coach/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('coach/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('coach/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('coach/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('coach/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('coach/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:coach')->name('coach.')->group(function () {
    Route::get('coach/verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('coach/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('coach/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('coach/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('coach/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('coach/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('coach/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
