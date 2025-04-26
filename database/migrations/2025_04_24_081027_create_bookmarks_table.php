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
    Schema::create('bookmarks', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
      $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bookmarks');
  }
};
