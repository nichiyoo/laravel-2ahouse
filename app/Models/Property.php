<?php

namespace App\Models;

use App\Helpers\Distance;
use App\Traits\HasImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{
  /** @use HasFactory<\Database\Factories\PropertyFactory> */
  use HasFactory, HasImageUpload;

  /**
   * The "booted" method of the model.
   *
   * @return void
   */
  protected static function booted()
  {
    static::addGlobalScope('price', function (Builder $builder) {
      $builder->withMin('rooms as min_price', 'price')
        ->withMax('rooms as max_price', 'price')
        ->groupBy('properties.id');
    });

    static::addGlobalScope('rating', function (Builder $builder) {
      $builder->withAvg('reviews as rating', 'rating');
    });
  }

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
   * The relationships that should be eager loaded on every query.
   *
   * @var array<string, string>
   */
  protected $with = [
    'bookmarks',
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
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function bookmarks(): BelongsToMany
  {
    return $this->BelongsToMany(Tenant::class, Bookmark::class)
      ->withTimestamps();
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
   * Getter for the ammenities of the property.
   *
   * @return \Illuminate\Support\Collection
   */
  public function getAmenitiesAttribute(): Collection
  {
    return $this->rooms->pluck('amenities')->collapse()->unique();
  }

  /**
   * Getter for the rating property.
   *
   * @return bool
   */
  public function getBookmarkedAttribute(): bool
  {
    $loaded = $this->relationLoaded('bookmarks');
    return $loaded && $this->bookmarks->contains('id', Auth::user()->tenant->id);
  }

  /**
   * Getter for the distance property.
   *
   * @return float
   */
  public function getDistanceAttribute(): float
  {
    $tenant = Auth::user()->tenant;

    if (!$tenant) return 0;
    return Distance::haversine(
      $tenant->latitude,
      $tenant->longitude,
      $this->latitude,
      $this->longitude
    );
  }
}
