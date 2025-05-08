<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AppController extends Controller
{
  /**
   * Display the main application page.
   */
  public function index(): RedirectResponse
  {
    $user = Auth::user();
    $role = $user->role;

    switch ($role) {
      case RoleType::TENANT:
        return redirect()->route('tenants.app');

      case RoleType::LANDLORD:
      case RoleType::ADMIN:
        return redirect()->route('tenants.app');

      default:
        return redirect()->route('onboard');
    }
  }

  /**
   * Display the configuration page.
   */
  public function config(): View
  {
    return view('config');
  }
}
