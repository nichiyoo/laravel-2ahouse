<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
  /** @use HasFactory<\Database\Factories\ReviewFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'tenant_id',
    'room_id',
    'comment',
    'rating',
  ];

  /**
   * Get the tenant associated with the review.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function tenant(): BelongsTo
  {
    return $this->belongsTo(Tenant::class);
  }

  /**
   * Get the property associated with the review.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function property(): BelongsTo
  {
    return $this->belongsTo(Property::class);
  }
}
