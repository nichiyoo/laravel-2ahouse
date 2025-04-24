<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
  /** @use HasFactory<\Database\Factories\RoleFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
  ];

  /**
   * Get the users associated with the role.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }
}
