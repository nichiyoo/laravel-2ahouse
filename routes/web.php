<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;

Route::middleware('guest')->get('/', fn() => view('onboard'))->name('onboard');

Route::middleware('auth')->group(function () {
  Route::get('app', [AppController::class, 'index'])->name('dashboard');
  Route::get('config', [AppController::class, 'config'])->name('config');
  Route::get('activity', [AppController::class, 'activity'])->name('activity');

  Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/tenant.php';
require __DIR__ . '/landlord.php';
