<?php

use App\Enums\PaymentMethod;
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
    $payments = PaymentMethod::cases();

    Schema::create('contracts', function (Blueprint $table) use ($payments) {
      $table->id();
      $table->timestamps();
      $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
      $table->foreignId('room_id')->constrained()->cascadeOnDelete();
      $table->date('start_date')->nullable();
      $table->date('end_date')->nullable();
      $table->enum('payment', array_map(fn($payment) => $payment->value, $payments))->default(PaymentMethod::CASH->value);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('contracts');
  }
};
