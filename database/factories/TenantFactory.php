<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'phone' => fake()->phoneNumber(),
      'address' => fake()->address(),
      'latitude' => fake()->latitude($min = -6.2, $max = -6.1),
      'longitude' => fake()->longitude($min = 106.7, $max = 106.9),
    ];
  }
}
