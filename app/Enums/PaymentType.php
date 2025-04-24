<?php

namespace App\Enums;

enum PaymentType: string
{
  case MONTHLY = 'monthly';
  case HALF_YEARLY = 'half-yearly';
  case YEARLY = 'yearly';

  /**
   * Get the label for the payment type.
   *
   * @return string
   */
  public function label(): string
  {
    return match ($this) {
      self::MONTHLY => 'Monthly',
      self::HALF_YEARLY => 'Half-Yearly',
      self::YEARLY => 'Yearly',
    };
  }

  /**
   * Get the description for the payment type.
   *
   * @return string
   */
  public function description(): string
  {
    return match ($this) {
      self::MONTHLY => 'Pay every month',
      self::HALF_YEARLY => 'Pay every six months',
      self::YEARLY => 'Pay every year',
    };
  }
}
