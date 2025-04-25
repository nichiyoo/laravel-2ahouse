<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
  /**
   * Display the main application page.
   * 
   * @return \Illuminate\Contracts\View\View
   */
  public function app(): View | RedirectResponse
  {
    $user = Auth::user();

    $completed = $user->tenant->completed;
    if (!$completed) return redirect()->route('profile.edit');

    $nearest = Property::inRandomOrder()
      ->with(['rooms', 'reviews'])
      ->hasRooms()
      ->get()
      ->sortByDesc('rating')
      ->take(5)
      ->values();

    $latest = Property::hasRooms()
      ->with(['rooms'])
      ->latest('updated_at')
      ->take(10)
      ->get();

    $combined = [
      ...$latest->pluck('id'),
      ...$nearest->pluck('id'),
    ];

    $others = Property::hasRooms()
      ->with(['rooms', 'landlord.user'])
      ->whereNotIn('id', $combined)
      ->take(8)
      ->get();

    return view('tenants.index', [
      'nearest' => $nearest,
      'latest' => $latest,
      'others' => $others,
    ]);
  }

  /**
   * Display list of properties.
   * 
   * @return \Illuminate\View\View
   */
  public function list(Request $request): View
  {
    $keyword = $request->get('query');

    $properties = Property::hasRooms()
      ->with(['rooms', 'landlord.user'])
      ->when(
        $keyword,
        function ($query) use ($keyword) {
          return $query
            ->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('city', 'like', '%' . $keyword . '%')
            ->orWhere('region', 'like', '%' . $keyword . '%')
            ->orWhere('address', 'like', '%' . $keyword . '%')
            ->orWhere('zipcode', 'like', '%' . $keyword . '%');
        }
      )
      ->take(8)
      ->get();

    return view('tenants.properties.explore', [
      'properties' => $properties,
    ]);
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
  public function store(StoreTenantRequest $request)
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
  public function update(UpdateTenantRequest $request, Tenant $tenant)
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
