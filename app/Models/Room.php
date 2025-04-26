<?php

namespace App\Models;

use App\Enums\AmenitiesType;
use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'price' => 'decimal:2',
      'images' => 'array',
      'payment' => PaymentType::class,
      'amenities' => AsEnumCollection::of(AmenitiesType::class),
    ];
  }

  /**
   * Get the property associated with the room.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function property(): BelongsTo
  {
    return $this->belongsTo(Property::class);
  }

  /**
   * Get the reviews associated with the room.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function reviews(): HasMany
  {
    return $this->hasMany(Review::class);
  }

  /**
   * Get the contracts associated with the room.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function contracts(): HasMany
  {
    return $this->hasMany(Contract::class);
  }

  /**
   * Getter for the average rating of the property.
   *
   * @return float
   */
  public function getRatingAttribute(): float
  {
    $rating =  $this->reviews->avg('rating');
    return round($rating, 1);
  }
}
