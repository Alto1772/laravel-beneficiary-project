<?php

use App\Models\Barangay;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('beneficiaries', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Barangay::class)->constrained()->cascadeOnDelete();
      $table->string('name')->nullable();
      $table->integer('age');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('beneficiaries');
  }
};
