<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
  /** @use HasFactory<\Database\Factories\ContractFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'tenant_id',
    'room_id',
    'start_date',
    'end_date',
    'payments',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'start_date' => 'date',
      'end_date' => 'date',
      'payments' => PaymentMethod::class,
    ];
  }

  /**
   * Get the tenant associated with the contract.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function tenant(): BelongsTo
  {
    return $this->belongsTo(Tenant::class);
  }

  /**
   * Get the room associated with the contract.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function room(): BelongsTo
  {
    return $this->belongsTo(Room::class);
  }
}
