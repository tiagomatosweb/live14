<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::post('/users/{user}', [\App\Http\Controllers\UserController::class, 'update']);
Route::post('/users/{user}/avatar', [\App\Http\Controllers\UserController::class, 'updateAvatar']);
