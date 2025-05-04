<?php

namespace App\Http\Controllers;

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

    $properties = $user->tenant->bookmarks()
      ->with('property.landlord.user', 'property.saves')
      ->get()
      ->pluck('property');

    return view('tenants.bookmarks.index', [
      'properties' => $properties,
    ]);
  }
}
