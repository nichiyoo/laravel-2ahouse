<?php

use App\Enums\PaymentType;
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
    $payments = PaymentType::cases();

    Schema::create('rooms', function (Blueprint $table) use ($payments) {
      $table->id();
      $table->timestamps();
      $table->string('type');
      $table->integer('capacity');
      $table->decimal('price', 10, 2);
      $table->json('images')->nullable();
      $table->json('amenities')->nullable();
      $table->enum('payment', array_map(fn($payment) => $payment->value, $payments))->default(PaymentType::MONTHLY->value);
      $table->foreignId('property_id')->constrained()->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('rooms');
  }
};
