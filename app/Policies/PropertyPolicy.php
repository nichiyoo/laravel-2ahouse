<?php

namespace App\Policies;

use App\Enums\RoleType;
use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool
  {
    return in_array($user->role, [
      RoleType::TENANT,
      RoleType::ADMIN,
    ]);
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Property $property): bool
  {
    return $property->landlord->user->is($user) || in_array($user->role, [
      RoleType::TENANT,
      RoleType::ADMIN,
    ]);
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    return $user->role === RoleType::LANDLORD;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Property $property): bool
  {
    return $property->landlord->user->is($user);
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Property $property): bool
  {
    return $property->landlord->user->is($user) || in_array($user->role, [
      RoleType::ADMIN,
    ]);
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Property $property): bool
  {
    return false;
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Property $property): bool
  {
    return false;
  }
}
