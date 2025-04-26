<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
  /**
   * Display the user's bookmarks.
   * 
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\View\View
   */
  public function index(): View
  {
    $user = Auth::user();
    $tenant = $user->tenant;

    $properties = Bookmark::with('property')
      ->where('tenant_id', $tenant->id)
      ->get()
      ->pluck('property')
      ->map(fn($property) => $property->load('landlord.user', 'rooms.reviews', 'saves'));

    return view('tenants.bookmarks.index', [
      'properties' => $properties,
    ]);
  }
}
