<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('auth')->group( function () {
    Route::get('login', [SteamAuthController::class, 'login']);
    Route::get('logout', [SteamAuthController::class, 'logout'])->name('logout');
});

Route::prefix('/add')->group( function () {
    Route::get('/', [ServerController::class, 'index'])->name('addpage');
    Route::post('/', [ServerController::class, 'addServer'])->name('server.store');
});

Route::get('/test', [TestController::class, 'index']);

