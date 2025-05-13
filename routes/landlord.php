<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\Landlords\PropertyController;
use App\Http\Controllers\Landlords\RoomController;

Route::middleware('auth', 'role:landlord', 'completed')
  ->as('landlords.')
  ->prefix('landlords')
  ->group(function () {
    Route::get('dashboard', [LandlordController::class, 'dashboard'])->name('dashboard');
    Route::get('area', [LandlordController::class, 'area'])->name('area');

    Route::resource('properties', PropertyController::class);
    Route::resource('properties.rooms', RoomController::class)->shallow();
  });
