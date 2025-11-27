<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', [\App\Http\Controllers\UserProfileController::class, 'show']);
    Route::put('/profile', [\App\Http\Controllers\UserProfileController::class, 'update']);
});

