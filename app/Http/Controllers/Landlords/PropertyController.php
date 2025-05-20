<?php

namespace App\Http\Controllers\Landlords;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PropertyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $properties = Auth::user()->landlord->properties;

    return view('landlords.properties.index', [
      'properties' => $properties->load('landlord.user'),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    $location = [
      'latitude' => -6.200000,
      'longitude' => 106.816666,
    ];

    return view('landlords.properties.create', [
      'location' => $location,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePropertyRequest $request): RedirectResponse
  {
    $validated = $request->except('image');

    $property = Property::create([
      ...$validated,
      'landlord_id' => Auth::user()->landlord->id,
    ]);

    $property->storeImage($request);
    $property->save();

    return redirect()->route('landlords.properties.index')
      ->with('success', 'Property created successfully.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Property $property): View
  {
    Gate::authorize('update', $property);

    $location = [
      'latitude' => $property->latitude,
      'longitude' => $property->longitude,
    ];

    return view('landlords.properties.edit', [
      'property' => $property,
      'location' => $location,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePropertyRequest $request, Property $property): RedirectResponse
  {
    Gate::authorize('update', $property);
    $validated = $request->except('image');

    $property->update($validated);
    $property->storeImage($request);
    $property->save();

    return redirect()->route('landlords.properties.index')
      ->with('success', 'Property updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Property $property): RedirectResponse
  {
    Gate::authorize('delete', $property);

    $property->deleteImage();
    $property->delete();

    return redirect()->route('landlords.properties.index')
      ->with('success', 'Property deleted successfully.');
  }
}
