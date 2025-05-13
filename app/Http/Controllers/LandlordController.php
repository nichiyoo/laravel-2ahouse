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
      ->withCount(['reviews'])
      ->with(['rooms', 'landlord'])
      ->get();

    $populars = $properties
      ->sortByDesc('rating')
      ->take(3)
      ->values();

    $count = $properties->count();
    $rating = $properties->sum('rating') / $count;
    $reviews = $properties->sum('reviews_count');

    return view('landlords.dashboard', [
      'properties' => $populars,
      'reviews' => $reviews,
      'count' => $count,
      'rating' => $rating,
    ]);
  }
}
