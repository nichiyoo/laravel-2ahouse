<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
  /** @use HasFactory<\Database\Factories\BookmarkFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'tenant_id',
    'room_id',
  ];

  /**
   * Get the tenant associated with the bookmark.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function tenant(): BelongsTo
  {
    return $this->belongsTo(Tenant::class);
  }

  /**
   * Get the room associated with the bookmark.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function room(): BelongsTo
  {
    return $this->belongsTo(Room::class);
  }
}
