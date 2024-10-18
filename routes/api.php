<?php

use App\Http\Controllers\BateriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfistaController;

Route::post('/surfistas', [SurfistaController::class, 'store']);
Route::resource('baterias', BateriaController::class);
