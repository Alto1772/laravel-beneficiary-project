<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('location');
      $table->timestamps();
    });

    Schema::table('beneficiaries', function (Blueprint $table) {
      $table->foreignIdFor(Project::class)->nullable()->constrained()->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('projects');

    Schema::table('beneficiaries', function (Blueprint $table) {
      $table->dropConstrainedForeignIdFor(Project::class);
    });
  }
};
