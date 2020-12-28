<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\SteamAuthController;
use App\Http\Controllers\ServerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
});

Route::prefix('auth')->group( function () {
    Route::get('login', [SteamAuthController::class, 'login']);
    Route::get('logout', [SteamAuthController::class, 'logout']);
});

Route::get('/server/add', [ServerController::class, 'index']);
Route::post('/server/add', [ServerController::class, 'addServer'])->name('server.store');
