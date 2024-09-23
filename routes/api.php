<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Middleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum', Middleware\TrackApiUsage::class]], function() {
    Route::get('makes', [Controllers\MakeController::class, 'index']);
    Route::get('makes/{make}/models', [Controllers\MakeModelController::class, 'index']);
    Route::get('models/{model}/generations', [Controllers\GenerationController::class, 'index']);
    Route::get('generations/{generation}/engines', [Controllers\EngineController::class, 'index']);
    Route::get('engines/{engine}', [Controllers\EngineController::class, 'show']);
});
