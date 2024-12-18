<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DVDController;
use App\Http\Controllers\GenreController;
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

    Route::apiResource('dvds', DVDController::class)
        ->except(['destroy']);

    Route::delete('dvds/{dvd}', [DVDController::class, 'destroy'])
        ->middleware('check.role:admin');
});