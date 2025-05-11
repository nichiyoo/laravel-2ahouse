<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Tenants\BookmarkController;
use App\Http\Controllers\Tenants\PropertyController;

Route::middleware('auth', 'role:tenant', 'completed')
  ->as('tenants.')
  ->prefix('tenants')
  ->group(function () {
    Route::get('dashboard', [TenantController::class, 'dashboard'])->name('dashboard');
    Route::get('area', [TenantController::class, 'area'])->name('area');

    Route::controller(PropertyController::class)
      ->prefix('properties')
      ->as('properties.')
      ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{property}', 'show')->name('show');
        Route::get('{property}/map', 'map')->name('map');
        Route::get('{property}/rent', 'rent')->name('rent');
        Route::get('{property}/rooms', 'rooms')->name('rooms');
        Route::get('{property}/review', 'review')->name('review');

        Route::post('{property}/bookmark', 'bookmark')->name('bookmark');
        Route::post('{property}/rent', 'reserve')->name('reserve');
      });

    Route::controller(BookmarkController::class)
      ->prefix('bookmarks')
      ->as('bookmarks.')
      ->group(function () {
        Route::get('', 'index')->name('index');
      });
  });
