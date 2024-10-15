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
            $table->integer('senior_id');
            $table->string('name');
            $table->string('relationship');
            $table->integer('age');
            $table->string('civil_status');
            $table->string('occupation');
            $table->string('income');
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
