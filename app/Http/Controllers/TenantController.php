<?php

namespace App\Http\Controllers;

use App\Helpers\Distance;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
  /**
   * Display a listing of the resource.
   * 
   * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
   */
  public function dashboard(): View | RedirectResponse
  {
    $properties = Property::with(['landlord.user'])
      ->hasRooms()
      ->get();

    $nearest = $properties->sortBy('distance')->take(5)->values();
    $latest = $properties->sortByDesc('updated_at')->take(10)->values();

    $combined_ids = [
      ...$latest->pluck('id'),
      ...$nearest->pluck('id'),
    ];

    $others = $properties->whereNotIn('id', $combined_ids)->take(8)->values();

    return view('tenants.dashboard', [
      'nearest' => $nearest,
      'latest' => $latest,
      'others' => $others,
    ]);
  }

  /**
   * Display a listing of the resource based on user location.
   * 
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\View\View
   */
  public function area(Request $request)
  {
    $user = Auth::user();
    $tenant = $user->tenant;

    $lat = $request->query('lat', $tenant->latitude);
    $lng = $request->query('lng', $tenant->longitude);
    $radius = $request->query('radius', 10);

    $properties = collect();

    $all = Property::whereNotNull('latitude')
      ->whereNotNull('longitude')
      ->get();

    $properties = $all->filter(function ($property) use ($lat, $lng, $radius) {
      $distance = Distance::haversine($lat, $lng, $property->latitude, $property->longitude);
      return $distance <= $radius;
    })->values();

    return view('tenants.properties.area', [
      'properties' => $properties,
      'lat' => $lat,
      'lng' => $lng,
    ]);
  }
}
