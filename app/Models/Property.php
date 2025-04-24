<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    'latitude' => 'decimal:8',
    'longitude' => 'decimal:8',
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
}
