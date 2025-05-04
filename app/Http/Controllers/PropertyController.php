<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Bookmark;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PropertyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index(Request $request): View
  {
    $keyword = $request->get('query');
    $min = $request->get('price_min');
    $max = $request->get('price_max');
    $rating = $request->get('rating');
    $distance = $request->get('distance');

    $properties = Property::hasRooms()
      ->with(['landlord.user', 'saves'])
      ->when($keyword, function ($query) use ($keyword) {
        return $query->where(function ($q) use ($keyword) {
          $q->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('city', 'like', '%' . $keyword . '%')
            ->orWhere('region', 'like', '%' . $keyword . '%')
            ->orWhere('address', 'like', '%' . $keyword . '%')
            ->orWhere('zipcode', 'like', '%' . $keyword . '%');
        });
      })
      ->get()
      ->when($distance, function ($query) use ($distance) {
        return $query->filter(function ($property) use ($distance) {
          return $property->distance <= $distance;
        });
      })
      ->take(12)
      ->sortBy('distance')
      ->values();

    return view('tenants.properties.index', [
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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   * 
   * @param  \App\Models\Property  $property
   * @return \Illuminate\View\View
   */
  public function show(Property $property): View
  {
    $property->load('landlord.user', 'saves');

    return view('tenants.properties.show', [
      'property' => $property,
    ]);
  }

  /**
   * Show the form for reviewing the specified resource.
   * 
   * @param  \App\Models\Property  $property
   * @return \Illuminate\View\View
   */
  public function review(Property $property): View
  {
    $property->load('reviews.tenant.user', 'landlord.user', 'saves');

    return view('tenants.properties.review', [
      'property' => $property,
    ]);
  }

  /**
   * Show the form for viewing the specified resource.
   * 
   * @param  \App\Models\Property  $property
   * @return \Illuminate\View\View
   */
  public function rooms(Property $property): View
  {
    $property->load('rooms', 'landlord.user', 'saves');

    return view('tenants.properties.rooms', [
      'property' => $property,
    ]);
  }

  /**
   * Show the form for viewing the specified resource.
   * 
   * @param  \App\Models\Property  $property
   * @return \Illuminate\View\View
   */
  public function map(Property $property): View
  {
    $property->load('saves');

    return view('tenants.properties.map', [
      'property' => $property,
    ]);
  }

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
   * Show the form for editing the specified resource.
   */
  public function edit(Property $property)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Property $property)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Property $property)
  {
    //
  }
}
