<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Bookmark;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
  /**
   * Bookmark a property for the user.
   *
   * @param  \App\Models\Property  $property
   * @return \Illuminate\Http\Response
   */
  public function bookmark(Property $property): RedirectResponse
  {
    $user = Auth::user();
    $tenant = $user->tenant;

    $found = Bookmark::where('tenant_id', $tenant->id)
      ->where('property_id', $property->id)
      ->first();

    if ($found) {
      $found->delete();
      session()->flash('success', 'Property removed from your bookmarks.');
      return redirect()->back();
    }

    Bookmark::create([
      'tenant_id' => $tenant->id,
      'property_id' => $property->id,
    ]);

    session()->flash('success', 'Property added to your bookmarks.');
    return redirect()->back();
  }

  /**
   * Show the form for requesting a rent.
   * 
   * @param  \App\Models\Property  $property
   * @return \Illuminate\View\View
   */
  public function rent(Property $property): View
  {
    $property->load(['rooms' => function ($query) {
      $query->where('capacity', '>', 0);
    }]);

    return view('tenants.properties.rent', [
      'property' => $property,
    ]);
  }
}
