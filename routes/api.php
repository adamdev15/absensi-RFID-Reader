<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Station Kiosk API
Route::prefix('station')->group(function () {
    Route::post('/heartbeat', [\App\Http\Controllers\Api\StationApiController::class, 'heartbeat']);
    Route::post('/attendance', [\App\Http\Controllers\Api\StationApiController::class, 'syncAttendance']);
    Route::post('/check-rfid', [\App\Http\Controllers\Api\StationApiController::class, 'checkRfid']);
});
