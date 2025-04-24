<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
  /** @use HasFactory<\Database\Factories\RoomFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'type',
    'capacity',
    'price',
    'images',
    'amenities',
    'payment',
    'property_id',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'price' => 'decimal:2',
    'images' => 'array',
    'amenities' => 'array',
  ];

  /**
   * Get the property associated with the room.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function property(): BelongsTo
  {
    return $this->belongsTo(Property::class);
  }
}
