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
   * Get the rents associated with the tenant.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function rents(): HasMany
  {
    return $this->hasMany(Rent::class);
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
