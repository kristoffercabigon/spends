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
        Schema::create('permanent_source', function (Blueprint $table) {
            $table->id();
            $table->integer('senior_id')->constrained('seniors');
            $table->tinyInteger('permanent_source')->default(0);
            $table->string('if_yes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permanent_source');
    }
};
