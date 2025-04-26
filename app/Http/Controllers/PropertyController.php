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

    $properties = Property::hasRooms()
      ->with(['rooms', 'landlord.user', 'saves'])
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
          $queries->whereBetween('price', [$min, $max]);
        });
      })
      ->when($rating, function ($query) use ($rating) {
        return $query->where('rating', '>=', $rating);
      })
      ->take(8)
      ->get();

    return view('tenants.properties.index', [
      'properties' => $properties,
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
    $lat = $request->query('lat', -6.1744);
    $lng = $request->query('lng', 106.8294);
    $radius = $request->query('radius', 10);

    $properties = collect();

    if ($lat && $lng) {
      $all = Property::whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get();

      $properties = $all->filter(function ($property) use ($lat, $lng, $radius) {
        $distance = $this->haversine($lat, $lng, $property->latitude, $property->longitude);
        return $distance <= $radius;
      })->values();
    }


    return view('tenants.properties.area', [
      'properties' => $properties,
      'lat' => $lat,
      'lng' => $lng,
    ]);
  }

  /**
   * Function to calculate the distance between two points on the earth.
   * 
   * @param  float  $lat1
   * @param  float  $lon1
   * @param  float  $lat2
   * @param  float  $lon2
   * @param  float  $radius  The radius of the earth in kilometers.
   * @return float
   */
  function haversine($lat1, $lon1, $lat2, $lon2, $radius = 6371)
  {
    $latFrom = deg2rad($lat1);
    $lonFrom = deg2rad($lon1);
    $latTo = deg2rad($lat2);
    $lonTo = deg2rad($lon2);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $sinLat = sin($latDelta / 2);
    $sinLon = sin($lonDelta / 2);
    $sinLatSq = pow($sinLat, 2);
    $sinLonSq = pow($sinLon, 2);

    $a = $sinLatSq + cos($latFrom) * cos($latTo) * $sinLonSq;
    $angle = 2 * asin(sqrt($a));

    return $angle * $radius;
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
    $property->load('rooms.reviews', 'landlord.user', 'saves');

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
