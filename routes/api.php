<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ServerController;
use App\Http\Middleware\CheckServerToken;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1/servers')->group(function () {
    Route::post('/search', [ServerController::class, 'search']);
    Route::middleware([CheckServerToken::class])->group(function () {
        Route::post('/create', [ServerController::class, 'create']);
        Route::prefix('{id}')->group(function () {
            Route::get('', [ServerController::class, 'read'])->withoutMiddleware([CheckServerToken::class]);
            Route::put('', [ServerController::class, 'update']);
            Route::delete('', [ServerController::class, 'delete']);
        });
    });
});
