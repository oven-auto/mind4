<?php

use App\Http\Controllers\Api\V1\Logist\LogistController;
use App\Http\Controllers\Api\V1\Meteo\MeteoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function(){
    Route::prefix('meteo')->group(function(){
        Route::get('', [MeteoController::class, 'index']);
    });

    Route::prefix('logist')->group(function(){
        Route::get('', [LogistController::class, 'index']);
    });
});
