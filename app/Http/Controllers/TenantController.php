<?php

namespace App\Http\Controllers;

use App\Helpers\Distance;
use App\Models\Tenant;
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
  public function app(): View | RedirectResponse
  {
    $user = Auth::user();
    $tenant = $user->tenant;

    $properties = Property::with(['landlord.user', 'saves'])
      ->hasRooms()
      ->get();

    $nearest = $properties->sortBy('distance')->take(5)->values();
    $latest = $properties->sortByDesc('updated_at')->take(10)->values();

    $combinedIds = [
      ...$latest->pluck('id'),
      ...$nearest->pluck('id'),
    ];

    $others = $properties->whereNotIn('id', $combinedIds)->take(8)->values();

    return view('tenants.index', [
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


  /**
   * Display the configuration page.
   * 
   * @return \Illuminate\Contracts\View\View
   */
  public function config()
  {
    return view('tenants.config');
  }

  /**
   * Display the activity page.
   * 
   * @return \Illuminate\Contracts\View\View
   */
  public function activity()
  {
    return view('tenants.activity');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Tenant $tenant)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tenant $tenant)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tenant $tenant)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tenant $tenant)
  {
    //
  }
}
