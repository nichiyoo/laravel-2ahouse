<?php

namespace App\Http\Controllers;

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
      ->withCount(['saves'])
      ->with(['rooms', 'landlord.user'])
      ->get();

    $populars = $properties
      ->sortByDesc('rating')
      ->take(3)
      ->values();

    $count = $properties->count();
    $bookmarked = $properties->sum('saves_count');
    $rating = $properties->sum('rating') / $count;

    return view('landlords.dashboard', [
      'properties' => $populars,
      'bookmarked' => $bookmarked,
      'count' => $count,
      'rating' => $rating,
    ]);
  }
}
