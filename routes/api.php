<?php

use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\ExternalRestApiController;
use App\Http\Controllers\AuthController;
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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::prefix('external-rest-api')->group(function () {
    Route::get('/', [ExternalRestApiController::class, 'index']);
    Route::post('/', [ExternalRestApiController::class, 'store']);
    Route::patch('/{id}', [ExternalRestApiController::class, 'update']);
    Route::delete('/{id}', [ExternalRestApiController::class, 'destroy']);
    Route::get('/{id}', [ExternalRestApiController::class, 'getServiceById']);
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('book')->group(function () {
        Route::get('/', [BooksController::class, 'index']);
        Route::post('/', [BooksController::class, 'store']);
        Route::patch('/{id}', [BooksController::class, 'update']);
        Route::delete('/{id}', [BooksController::class, 'destroy']);
        Route::get('get-specific/{id}', [BooksController::class, 'getSpecific']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});

