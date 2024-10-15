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
        Schema::create('living_arrangement', function (Blueprint $table) {
            $table->id();
            $table->integer('senior_id')->constrained('seniors');
            $table->string('type_of_living_arrangement');
            $table->string('others_remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('living_arrangement');
    }
};
