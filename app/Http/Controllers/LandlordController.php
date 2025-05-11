<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
   */
  public function dashboard()
  {
    $user = Auth::user();
    $landlord = $user->landlord;

    $properties = $landlord->properties()
      ->with(['rooms', 'saves'])
      ->hasRooms()
      ->get();

    return view('landlords.dashboard', [
      'properties' => $properties,
      'count' => $properties->count(),
    ]);
  }
}
