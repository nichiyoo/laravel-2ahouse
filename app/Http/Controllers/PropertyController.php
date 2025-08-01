<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Bookmark;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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

    $query = Property::hasRooms()
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
      ->when($min && $max, function ($query) use ($min, $max) {
        return $query->whereHas('rooms', function ($queries) use ($min, $max) {
          $queries->whereBetween('price', [
            $min,
            $max
          ]);
        });
      });

    if ($rating) $query->having('rating', '>=', $rating);
    $properties = $query->get();

    if ($distance) {
      $properties = $properties->filter(function ($property) use ($distance) {
        return $property->distance <= $distance;
      });
    }

    $properties = $properties->take(12)
      ->sortBy('distance')
      ->values();

    return view('properties.index', [
      'properties' => $properties,
    ]);
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

    return view('properties.show', [
      'property' => $property,
    ]);
  }

  /**
   * Show the form for reviewing the specified resource.
   * 
   * @param  \App\Models\Property  $property
   * @return \Illuminate\View\View
   */
  public function reviews(Property $property): View
  {
    $property->load('reviews.tenant.user', 'landlord.user', 'saves');

    return view('properties.reviews', [
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
    $property->load('landlord.user', 'saves');

    return view('properties.rooms', [
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

    return view('properties.map', [
      'property' => $property,
    ]);
  }
}
