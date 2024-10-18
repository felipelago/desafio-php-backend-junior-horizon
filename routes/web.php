<?php

use App\Http\Controllers\BateriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfistaController;

Route::middleware('api')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('surfistas', SurfistaController::class);
    Route::resource('baterias', BateriaController::class);
});
