<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('ranking', \App\Http\Controllers\RankingController::class);
Route::apiResource('group', App\Http\Controllers\GroupController::class);
Route::apiResource('activity', App\Http\Controllers\ActivityController::class);
