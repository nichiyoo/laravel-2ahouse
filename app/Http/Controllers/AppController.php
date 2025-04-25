<?php

namespace App\Http\Controllers;

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
    $role = $user->role->name;

    switch ($role) {
      case 'tenant':
        return redirect()->route('tenants.app');

      case 'landlord':
      case 'admin':
        Auth::logout();
        return;
    }
  }
}
