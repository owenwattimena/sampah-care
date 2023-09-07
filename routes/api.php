<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use Illuminate\Http\Request;
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

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('report', [ReportController::class, 'index']);
        Route::get('report/total', [ReportController::class, 'getTotalReport']);
        Route::post('report', [ReportController::class, 'save']);
        Route::get('report/{id}', [ReportController::class, 'show']);
    });

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
