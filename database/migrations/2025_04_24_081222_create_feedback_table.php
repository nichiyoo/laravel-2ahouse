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
    Schema::create('feedback', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->string('title');
      $table->text('description');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('feedback');
  }
};
