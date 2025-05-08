<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    'role',
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
      'role' => RoleType::class,
    ];
  }

  /**
   * Get the landlord associated with the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function landlord(): HasOne
  {
    return $this->hasOne(Landlord::class)->withDefault([
      'comleted' => false,
    ]);
  }

  /**
   * Get the tenant associated with the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function tenant(): HasOne
  {
    return $this->hasOne(Tenant::class)->withDefault([
      'completed' => false,
    ]);
  }

  /**
   * Get the feedbacks associated with the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function feedbacks(): HasMany
  {
    return $this->hasMany(Feedback::class);
  }

  /**
   * Getter to check if user profile is completed.
   *
   * @return bool
   */
  public function getCompletedAttribute(): bool
  {
    return match ($this->role) {
      RoleType::ADMIN => true,
      RoleType::TENANT => $this->tenant->completed,
      RoleType::LANDLORD => $this->landlord->completed,
      default => false,
    };
  }
}
