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
    Schema::create('landlords', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('phone')->nullable();
      $table->string('avatar')->nullable();
      $table->string('backdrop')->nullable();
      $table->boolean('completed')->default(false);
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('landlords');
  }
};
