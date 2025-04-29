<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('onboard'))->middleware('guest')->name('onboard');

Route::middleware('auth')->group(function () {
  Route::get('/app', [AppController::class, 'index'])->name('dashboard');
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')
  ->as('tenants.')
  ->prefix('tenants')
  ->group(function () {
    Route::get('/app', [TenantController::class, 'app'])->name('app');
    Route::get('/area', [TenantController::class, 'area'])->name('area');
    Route::get('/config', [TenantController::class, 'config'])->name('config');
    Route::get('/activity', [TenantController::class, 'activity'])->name('activity');

    Route::controller(PropertyController::class)
      ->prefix('properties')
      ->as('properties.')
      ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{property}', 'show')->name('show');
        Route::get('/{property}/map', 'map')->name('map');
        Route::get('/{property}/rent', 'rent')->name('rent');
        Route::get('/{property}/rooms', 'rooms')->name('rooms');
        Route::get('/{property}/review', 'review')->name('review');
        Route::post('/{property}/bookmark', 'bookmark')->name('bookmark');
      });

    Route::controller(BookmarkController::class)
      ->prefix('bookmarks')
      ->as('bookmarks.')
      ->group(function () {
        Route::get('/', 'index')->name('index');
      });
  });

require __DIR__ . '/auth.php';
