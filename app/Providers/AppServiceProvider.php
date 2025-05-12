<?php

namespace App\Providers;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Model::preventLazyLoading();
    Blade::if('landlord', fn() => Auth::check() && Auth::user()->role == RoleType::LANDLORD);
    Blade::if('tenant', fn() => Auth::check() && Auth::user()->role == RoleType::TENANT);
  }
}
