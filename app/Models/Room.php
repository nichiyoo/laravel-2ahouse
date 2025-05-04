<?php

namespace App\Models;

use App\Enums\AmenitiesType;
use App\Enums\PaymentType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Scope;

class RatingScope implements Scope
{
  /**
   * Apply the scope to a given Eloquent query builder.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $builder
   * @param  \Illuminate\Database\Eloquent\Model  $model
   * @return void
   */
  public function apply(Builder $builder, Model $model)
  {
    $builder->withAvg('reviews as rating', 'rating');
  }
}

class Room extends Model
{
  /** @use HasFactory<\Database\Factories\RoomFactory> */
  use HasFactory;

  /**
   * The "booted" method of the model.
   *
   * @return void
   */
  protected static function booted()
  {
    static::addGlobalScope(new RatingScope);
  }

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
}
