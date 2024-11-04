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
        Schema::create('family_composition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_id')->constrained('seniors')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('relative_relationship')->nullable();
            $table->integer('relative_age')->nullable();
            $table->foreignId('relative_civil_status')->constrained('civil_status_list')->nullable(); // Change this line
            $table->string('relative_occupation')->nullable();
            $table->string('relative_income')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_composition');
    }
};
