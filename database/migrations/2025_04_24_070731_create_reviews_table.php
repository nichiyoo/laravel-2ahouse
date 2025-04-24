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
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
      $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
      $table->text('comment')->nullable();
      $table->integer('rating')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reviews');
  }
};
