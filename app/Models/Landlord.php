<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Landlord extends Model
{
  /** @use HasFactory<\Database\Factories\LandlordFactory> */
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
    'backdrop',
  ];

  /**
   * Get the user associated with the landlord.
   * 
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the properties associated with the landlord.
   * 
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function properties(): HasMany
  {
    return $this->hasMany(Property::class);
  }
}
