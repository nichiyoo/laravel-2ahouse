<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => 'Kos' . ' ' . fake()->streetName(),
      'address' => fake()->streetAddress(),
      'city' => fake()->city(),
      'region' => fake()->state(),
      'zipcode' => fake()->postcode(),
      'description' => fake()->paragraphs(3, true),
      'image' => asset('images/placeholders/property.jpg'),
      'latitude' => fake()->latitude($min = -6.2, $max = -6.1),
      'longitude' => fake()->longitude($min = 106.7, $max = 106.9),
      'created_at' => fake()->dateTimeBetween('-1 year'),
      'updated_at' => fake()->dateTimeBetween('-1 year'),
    ];
  }
}
