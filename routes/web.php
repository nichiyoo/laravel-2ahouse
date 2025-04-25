<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/map', [TenantController::class, 'index'])->name('map');
    Route::get('/search', [TenantController::class, 'list'])->name('search');
    Route::get('/activity', [TenantController::class, 'index'])->name('activity');
  });

require __DIR__ . '/auth.php';
