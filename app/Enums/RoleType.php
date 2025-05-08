<?php

namespace App\Enums;

enum RoleType: string
{
  case ADMIN = 'admin';
  case TENANT = 'tenant';
  case LANDLORD = 'landlord';

  /**
   * Get the label for the role type.
   *
   * @return string
   */
  public function label(): string
  {
    return match ($this) {
      self::ADMIN => 'Admin',
      self::TENANT => 'User',
      self::LANDLORD => 'Owner',
    };
  }

  /**
   * Get the description for the role type.
   *
   * @return string
   */
  public function description(): string
  {
    return match ($this) {
      self::ADMIN => 'Administrator with full access',
      self::TENANT => 'Tenant with limited access',
      self::LANDLORD => 'Landlord with property management access',
    };
  }
}
