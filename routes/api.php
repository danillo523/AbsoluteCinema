<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DvdController;
use App\Http\Controllers\DvdCopyController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->middleware(['auth:sanctum', 'check.role:admin']);
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
    Route::get('me', 'me')->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('customer', CustomerController::class)
        ->except(['destroy']);

    Route::delete('customer/{customer}', [CustomerController::class, 'destroy'])
        ->middleware('check.role:admin');

    Route::apiResource('genres', GenreController::class)
        ->except(['destroy']);

    Route::delete('genres/{genre}', [GenreController::class, 'destroy'])
        ->middleware('check.role:admin');

    Route::apiResource('dvds', DvdController::class)
        ->except(['destroy']);

    Route::delete('dvds/{dvd}', [DvdController::class, 'destroy'])
        ->middleware('check.role:admin');

    Route::apiResource('dvd-copies', DvdCopyController::class)
        ->except(['destroy']);

    Route::delete('dvd-copies/{dvd_copy}', [DvdCopyController::class, 'destroy'])
        ->middleware('check.role:admin');

    Route::post('rentals/rent', [RentalController::class, 'rent']);
    Route::post('rentals/return/{id}', [RentalController::class, 'return']);
});