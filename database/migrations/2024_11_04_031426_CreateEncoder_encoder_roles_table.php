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
        Schema::create('encoder_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encoder_user_id')->constrained('encoder');
            $table->foreignId('encoder_roles_id')->nullable()->constrained('encoder_roles_list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encoder_roles');
    }
};
