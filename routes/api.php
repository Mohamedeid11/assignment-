<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TimesheetController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\AttributeValuesController;
use App\Http\Controllers\Api\AuthenticationController;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// Protected routes
Route::middleware('apiAuth')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('timesheets', TimesheetController::class);
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('attribute_values', AttributeValuesController::class);
});
