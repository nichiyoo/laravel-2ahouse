<?php

namespace App\Http\Controllers\Landlords;

use App\Enums\AmenitiesType;
use App\Enums\PaymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
  /**
   * Show the form for creating a new resource.
   */
  public function create(Property $property)
  {
    $payments = PaymentType::cases();
    $amenities = AmenitiesType::cases();

    return view('landlords.rooms.create', [
      'property' => $property,
      'payments' => $payments,
      'amenities' => $amenities,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreRoomRequest $request, Property $property)
  {
    $validated = $request->except('images');

    $room = Room::create([
      ...$validated,
      'property_id' => $property->id,
    ]);

    $room->storeImages($request);
    $room->save();

    return redirect()->route('properties.rooms', [
      'property' => $property
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Room $room)
  {
    Gate::authorize('update', $room);

    $property = $room->property;

    return view('landlords.rooms.edit', [
      'room' => $room,
      'property' => $property,
      'payments' => PaymentType::cases(),
      'amenities' => AmenitiesType::cases(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateRoomRequest $request, Room $room)
  {
    Gate::authorize('update', $room);
    $validated = $request->except('images');

    $room->update($validated);
    $room->storeImages($request);
    $room->save();

    return redirect()->route('properties.rooms', [
      'property' => $room->property
    ])
      ->with('success', 'Room updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Room $room)
  {
    Gate::authorize('delete', $room);
    $room->deleteImages();
    $room->delete();

    return redirect()->route('properties.rooms', [
      'property' => $room->property
    ])
      ->with('success', 'Room deleted successfully');
  }
}
