<?php

use App\Http\Controllers\BateriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfistaController;

Route::resource('surfistas', SurfistaController::class);
Route::resource('baterias', BateriaController::class);
