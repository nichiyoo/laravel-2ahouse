<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
  Route::get('/map', fn() => view('dashboard'))->name('map');
  Route::get('/search', fn() => view('dashboard'))->name('search');
  Route::get('/activity', fn() => view('dashboard'))->name('activity');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
