<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\polylinesController;
use App\Http\Controllers\poygonsController;

Route::get('/', [PointsController::class, 'index'])->name('map');

Route::get('/table', [TableController::class, 'index'])->name('table');



Route::resource('points', PointsController::class);
Route::resource('polylines', polylinesController::class);
Route::resource('poygons', poygonsController::class);

