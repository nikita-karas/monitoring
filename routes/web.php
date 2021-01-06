<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\SteamAuthController;
use App\Http\Controllers\ServerAddController;

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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('/auth')->group(function () {
    Route::get('login', [SteamAuthController::class, 'login'])->name('login');
    Route::get('logout', [SteamAuthController::class, 'logout'])->name('logout');
});

Route::prefix('/add')->group(function () {
    Route::get('/', [ServerAddController::class, 'index'])->name('server.add.page');
    Route::post('/', [ServerAddController::class, 'addServer'])->name('server.store');
});

Route::get('/{slug}', [MainController::class, 'showGamePage'])->name('gamepage');

Route::fallback(function () {
    abort(404);
});
