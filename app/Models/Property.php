<?php

namespace App\Models;

use App\Helper\Distance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
   * Get the contracts associated with the property.
   *  
   * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
   */
  public function contracts(): HasManyThrough
  {
    return $this->hasManyThrough(Contract::class, Room::class);
  }

  /**
   * Get the bookmarks associated with the room.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function bookmarks(): HasMany
  {
    return $this->hasMany(Bookmark::class);
  }

  /**
   * Get the bookmarks associated with the room.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function saves(): HasMany
  {
    $user = Auth::user();
    if (!$user) return $this->hasMany(Bookmark::class);
    if ($user->role->name !== 'tenant') return $this->hasMany(Bookmark::class);

    return $this->hasMany(Bookmark::class)
      ->where('tenant_id', $user->tenant->id);
  }

  /**
   * Scope to filter properties that have available rooms (capacity > 0).
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeHasRooms(Builder $query): Builder
  {
    return $query->whereHas('rooms', function ($query) {
      $query->where('capacity', '>', 0);
    });
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
   * Getter for the maximum price of the property.
   *
   * @return float
   */
  public function getMaxPriceAttribute(): float
  {
    return $this->rooms->max('price');
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


  /**
   * Getter for the ammenities of the property.
   *
   * @return \Illuminate\Support\Collection
   */
  public function getAmenitiesAttribute(): Collection
  {
    return $this->rooms->pluck('amenities')->collapse()->unique();
  }

  /**
   * Getter for the bookmarked property.
   *
   * @return bool
   */
  public function getBookmarkedAttribute(): bool
  {
    return $this->relationLoaded('saves')
      ? $this->saves->isNotEmpty()
      : false;
  }

  /**
   * Getter for the distance property.
   *
   * @return float
   */
  public function getDistanceAttribute(): float | null
  {
    $user = Auth::user();
    $tenant = $user->tenant;

    if (!$tenant) return null;

    return Distance::haversine(
      $tenant->latitude,
      $tenant->longitude,
      $this->latitude,
      $this->longitude
    );
  }
}
