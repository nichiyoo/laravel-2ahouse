<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;

Route::middleware('guest')->get('/', fn() => view('onboard'))->name('onboard');

Route::middleware('auth')->group(function () {
  Route::get('app', [AppController::class, 'index'])->name('dashboard');
  Route::get('config', [AppController::class, 'config'])->name('config');
  Route::get('activity', [AppController::class, 'activity'])->name('activity');

  Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::controller(PropertyController::class)
    ->prefix('properties')
    ->as('properties.')
    ->group(function () {
      Route::get('/', 'index')->name('index');
      Route::get('{property}', 'show')->name('show');
      Route::get('{property}/map', 'map')->name('map');
      Route::get('{property}/rooms', 'rooms')->name('rooms');
      Route::get('{property}/reviews', 'reviews')->name('reviews');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/tenant.php';
require __DIR__ . '/landlord.php';
