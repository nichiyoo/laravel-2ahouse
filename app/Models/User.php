<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'role_id',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Get the role associated with the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  /**
   * Get the landlord associated with the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function landlord(): HasOne
  {
    return $this->hasOne(Landlord::class);
  }

  /**
   * Get the tenant associated with the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function tenant(): HasOne
  {
    return $this->hasOne(Tenant::class);
  }
}
