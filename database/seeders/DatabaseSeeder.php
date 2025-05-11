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
      'user_id' => User::factory()->create([
        'name' => 'Landlord',
        'email' => 'landlord@example.com',
        'role' => RoleType::LANDLORD,
      ])->id,
      'completed' => true,
    ]);

    Tenant::factory()->create([
      'user_id' => User::factory()->create([
        'name' => 'Tenant',
        'email' => 'tenant@example.com',
        'role' => RoleType::TENANT,
      ])->id,
      'completed' => true,
    ]);

    User::factory()->count(20)->create([
      'role' => RoleType::TENANT,
    ]);

    User::factory()->count(10)->create([
      'role' => RoleType::LANDLORD,
    ]);

    $users = User::whereIn('role', [
      RoleType::LANDLORD,
      RoleType::TENANT
    ])
      ->where(function ($query) {
        $query->where('role', RoleType::TENANT)->whereDoesntHave('tenant', function ($query) {
          $query->where('completed', true);
        });
      })
      ->orWhere(function ($query) {
        $query->where('role', RoleType::LANDLORD)->whereDoesntHave('landlord', function ($query) {
          $query->where('completed', true);
        });
      })
      ->get();

    foreach ($users as $user) {
      switch ($user->role) {
        case RoleType::LANDLORD:
          Landlord::factory()->create(['user_id' => $user->id]);
          break;

        case RoleType::TENANT:
          Tenant::factory()->create(['user_id' => $user->id]);
          break;
      }
    }

    $landlords = Landlord::with('user')->get();
    foreach ($landlords as $landlord) {
      Property::factory()->count(rand(1, 3))->create([
        'landlord_id' => $landlord->id,
      ]);
    }

    $properties = Property::get();
    foreach ($properties as $property) {
      Room::factory()->count(rand(1, 3))->create([
        'property_id' => $property->id,
      ]);
    }

    $rooms = Room::get();
    foreach ($rooms as $room) {
      $tenant = Tenant::inRandomOrder()->first();

      Review::factory()->count(rand(1, 3))->create([
        'room_id' => $room->id,
        'tenant_id' => $tenant->id,
      ]);
    }
  }
}
