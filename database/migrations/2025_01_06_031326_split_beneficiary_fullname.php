<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('beneficiaries', function (Blueprint $table) {
      $table->renameColumn('name', 'first_name');
      $table->string('middle_initial', 5)->nullable();
      $table->string('last_name', 20)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('beneficiaries', function (Blueprint $table) {
      $table->renameColumn('first_name', 'name');
      $table->dropColumn('middle_initial', 5);
      $table->dropColumn('last_name', 20);
    });
  }
};
