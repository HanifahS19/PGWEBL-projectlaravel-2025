<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\pointsController;
use App\Http\Controllers\poygonsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\polylinesController;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class,'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('points', pointsController::class);
Route::resource('polylines', polylinesController::class);
Route::resource('poygons', poygonsController::class);

Route::get('/map', [pointsController::class, 'index'])->middleware('auth', 'verified')
->name('map');
Route::get('/table', [TableController::class, 'index'])->name('table');

require __DIR__.'/auth.php';
