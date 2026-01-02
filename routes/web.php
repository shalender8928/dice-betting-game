<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('games')->name('games.')->controller(GameController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/play', 'create')->name('play');
    Route::post('/', 'store')->name('store');
    Route::get('/result', 'result')->name('result');
    Route::post('/exit', 'exit')->name('exit');
    Route::post('/reset-balance', 'resetBalance')->name('reset-balance');
});