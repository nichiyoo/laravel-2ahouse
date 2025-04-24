<?php

namespace Database\Factories;

use App\Enums\AmenitiesType;
use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $price = fake()->numberBetween(5, 30) * 100000;

    return [
      'type' => fake()->regexify('Kamar Tipe [A-Z]{1}'),
      'capacity' => fake()->numberBetween(1, 10),
      'price' => $price,
      'images' => [],
      'payment' => fake()->randomElement(PaymentType::class),
      'amenities' => fake()->randomElements(AmenitiesType::class, fake()->numberBetween(3, 8)),
    ];
  }
}
