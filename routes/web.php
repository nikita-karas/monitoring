<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\SteamAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerAddController;
use App\Http\Controllers\GameController;
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
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::prefix('/auth')->group(function () {
    Route::get('login', [SteamAuthController::class, 'login'])->name('login');
    Route::get('logout', [SteamAuthController::class, 'logout'])->name('logout');
});

Route::prefix('/profile')->group(function (){
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::post('/', [ProfileController::class, 'changeToken'])->name('token.change');
    Route::delete('/{id}', [ProfileController::class, 'destroyServer'])->name('server.delete');
});

Route::prefix('/add')->group(function () {
    Route::get('/', [ServerAddController::class, 'index'])->name('server.add.page');
    Route::post('/', [ServerAddController::class, 'addServer'])->name('server.store');
});

Route::get('/{slug}', [GameController::class, 'index'])->name('game.page');
Route::get('/{slug}/search', [GameController::class, 'search'])->name('game.search');
Route::get('/{slug}/{id}', [ServerController::class, 'index'])->name('server.page');

Route::fallback(function () {
    abort(404);
});
