<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
  /**
   * Display the main application page.
   */
  public function index()
  {
    $user = Auth::user();
    $role = $user->role;

    switch ($role) {
      case RoleType::TENANT:
        return redirect()->route('tenants.app');

      case RoleType::LANDLORD:
      case RoleType::ADMIN:
        return redirect()->route('tenants.app');
    }
  }
}
