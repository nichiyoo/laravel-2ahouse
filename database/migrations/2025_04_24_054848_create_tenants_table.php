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
    Schema::create('tenants', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('phone')->nullable();
      $table->string('avatar')->nullable();
      $table->text('address')->nullable();
      $table->decimal('latitude', 10, 6)->nullable();
      $table->decimal('longitude', 10, 6)->nullable();
      $table->boolean('completed')->default(false);
      $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tenants');
  }
};
