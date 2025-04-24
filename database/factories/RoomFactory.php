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
    $price = fake()->numberBetween(100, 1000) * 1000;
    $payments = array_map(fn(PaymentType $payment) => $payment->value, PaymentType::cases());
    $ammenities = array_map(fn(AmenitiesType $amenity) => $amenity->value, AmenitiesType::cases());

    return [
      'type' => fake()->word(),
      'capacity' => fake()->numberBetween(1, 10),
      'price' => $price,
      'images' => [],
      'payment' => fake()->randomElement($payments),
      'amenities' => fake()->randomElements($ammenities, fake()->numberBetween(3, 8)),
    ];
  }
}
