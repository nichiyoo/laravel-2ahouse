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

    $admin = Role::where('name', 'admin')->first();
    $landlord = Role::where('name', 'landlord')->first();
    $tenant = Role::where('name', 'tenant')->first();

    User::factory()->create([
      'name' => 'Administrator',
      'email' => 'admin@example.com',
      'role_id' => $admin->id,
    ]);

    Landlord::factory()->create([
      'user_id' => User::factory()->create([
        'name' => 'Landlord',
        'email' => 'landlord@example.com',
        'role_id' => $landlord,
      ])->id,
    ]);

    Tenant::factory()->create([
      'user_id' => User::factory()->create([
        'name' => 'Tenant',
        'email' => 'tenant@example.com',
        'role_id' => $tenant->id,
      ])->id,
    ]);

    User::factory()->count(20)->create([
      'role_id' => $tenant->id,
    ]);

    User::factory()->count(10)->create([
      'role_id' => $landlord->id,
    ]);

    $users = User::whereIn('role_id', [
      $landlord->id,
      $tenant->id
    ])->get();

    foreach ($users as $user) {
      switch ($user->role_id) {
        case $landlord->id:
          Landlord::factory()->create(['user_id' => $user->id]);
          break;

        case $tenant->id:
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
  }
}
