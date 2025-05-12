<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
  /** @use HasFactory<\Database\Factories\TenantFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'user_id',
    'phone',
    'avatar',
    'address',
    'latitude',
    'longitude',
    'completed',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'latitude' => 'decimal:6',
    'longitude' => 'decimal:6',
    'completed' => 'boolean',
  ];


  /**
   * Get the user associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the reviews associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function reviews(): BelongsToMany
  {
    return $this->BelongsToMany(Room::class, Review::class)
      ->withPivot('rating', 'comment')
      ->withTimestamps();
  }

  /**
   * Get the contracts associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function contracts(): BelongsToMany
  {
    return $this->belongsToMany(Room::class, Contract::class)
      ->withPivot('start_date', 'end_date', 'payment')
      ->withTimestamps();
  }

  /**
   * Get the bookmarks associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function bookmarks(): BelongsToMany
  {
    return $this->belongsToMany(Property::class, Bookmark::class)
      ->withTimestamps();
  }
}
