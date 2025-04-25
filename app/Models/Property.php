<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Property extends Model
{
  /** @use HasFactory<\Database\Factories\PropertyFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'address',
    'city',
    'region',
    'zipcode',
    'image',
    'description',
    'latitude',
    'longitude',
    'landlord_id',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'latitude' => 'decimal:6',
    'longitude' => 'decimal:6',
  ];

  /**
   * Get the landlord associated with the property.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function landlord(): BelongsTo
  {
    return $this->belongsTo(Landlord::class);
  }

  /**
   * Get the rooms associated with the property.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function rooms(): HasMany
  {
    return $this->hasMany(Room::class);
  }

  /**
   * Get the reviews associated with the property.
   *  
   * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
   */
  public function reviews(): HasManyThrough
  {
    return $this->hasManyThrough(Review::class, Room::class);
  }

  /**
   * Get the rents associated with the property.
   *  
   * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
   */
  public function rents(): HasManyThrough
  {
    return $this->hasManyThrough(Rent::class, Room::class);
  }

  /**
   * Scope to filter properties by the rooms availability.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeHasRooms(Builder $query): Builder
  {
    return $query->whereHas('rooms');
  }

  /**
   * Getter for starting price of the property.
   *
   * @return float
   */
  public function getMinPriceAttribute(): float
  {
    return $this->rooms->min('price');
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
