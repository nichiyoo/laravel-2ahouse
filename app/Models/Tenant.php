<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function reviews(): HasMany
  {
    return $this->hasMany(Review::class);
  }

  /**
   * Get the contracts associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function contracts(): HasMany
  {
    return $this->hasMany(Contract::class);
  }

  /**
   * Get the bookmarks associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function bookmarks(): HasMany
  {
    return $this->hasMany(Bookmark::class);
  }
}
