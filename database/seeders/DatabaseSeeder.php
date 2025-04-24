<?php

namespace Database\Seeders;

use App\Models\Landlord;
use App\Models\Property;
use App\Models\Role;
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
    foreach (['admin', 'landlord', 'tenant'] as $role) {
      Role::factory()->create([
        'name' => $role,
      ]);
    }

    $admin = User::factory()->create([
      'name' => 'Administrator',
      'email' => 'admin@example.com',
      'role_id' => Role::where('name', 'admin')->first()->id,
    ]);

    $landord = Landlord::factory()->create([
      'user_id' => User::factory()->create([
        'name' => 'Landlord',
        'email' => 'landlord@example.com',
        'role_id' => Role::where('name', 'landlord')->first()->id,
      ])->id,
    ]);

    $tenant = Tenant::factory()->create([
      'user_id' => User::factory()->create([
        'name' => 'Tenant',
        'email' => 'tenant@example.com',
        'role_id' => Role::where('name', 'tenant')->first()->id,
      ])->id,
    ]);

    User::factory(10)->create([
      'role_id' => Role::where('name', 'tenant')->first()->id,
    ]);

    $property = Property::factory()->create([
      'name' => 'Kos Testing',
      'landlord_id' => $landord->id,
    ]);

    Room::factory(2)->create([
      'property_id' => $property->id,
    ]);
  }
}
