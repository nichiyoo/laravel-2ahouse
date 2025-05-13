<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Landlord;
use App\Models\Property;
use App\Models\Review;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory()->create([
      'name' => 'Administrator',
      'email' => 'admin@example.com',
      'role' => RoleType::ADMIN,
    ]);

    Landlord::factory()->create([
      'completed' => true,
      'user_id' => User::factory()->create([
        'name' => 'Landlord',
        'email' => 'landlord@example.com',
        'role' => RoleType::LANDLORD,
      ])->id,
    ]);

    Tenant::factory()->create([
      'completed' => true,
      'user_id' => User::factory()->create([
        'name' => 'Tenant',
        'email' => 'tenant@example.com',
        'role' => RoleType::TENANT,
      ])->id,
    ]);

    User::factory()->count(20)->create([
      'role' => RoleType::TENANT,
    ])->each(function ($user) {
      Tenant::factory()->create([
        'user_id' => $user->id,
        'completed' => true,
      ]);
    });

    User::factory()->count(10)->create([
      'role' => RoleType::LANDLORD,
    ])->each(function ($user) {
      Landlord::factory()->create([
        'user_id' => $user->id,
        'completed' => true,
      ]);
    });

    Landlord::with('user')->get()->each(function ($landlord) {
      $count = rand(1, 3);
      Property::factory()->count($count)->create([
        'landlord_id' => $landlord->id,
      ]);
    });

    Property::get()->each(function ($property) {
      $count = rand(2, 4);
      Room::factory()->count($count)->create([
        'property_id' => $property->id,
      ]);
    });

    Room::get()->each(function ($room) {
      $count = rand(1, 3);
      Tenant::inRandomOrder()->take($count)->get()->each(function ($tenant) use ($room) {
        Review::factory()->create([
          'room_id' => $room->id,
          'tenant_id' => $tenant->id,
        ]);
      });
    });
  }
}
