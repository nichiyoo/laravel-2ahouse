<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('properties', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('name');
      $table->string('address');
      $table->string('city');
      $table->string('region');
      $table->string('zipcode');
      $table->string('image');
      $table->text('description');
      $table->decimal('latitude', 10, 6);
      $table->decimal('longitude', 10, 6);
      $table->foreignId('landlord_id')->constrained()->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('properties');
  }
};
