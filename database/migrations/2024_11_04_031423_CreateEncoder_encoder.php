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
        Schema::create('encoder', function (Blueprint $table) {
            $table->id();
            $table->string('encoder_first_name');
            $table->string('encoder_middle_name')->nullable();
            $table->string('encoder_last_name');
            $table->string('encoder_email');
            $table->string('encoder_password');
            $table->string('encoder_profile_picture')->nullable();
            $table->integer('encoder_verification_code')->nullable();
            $table->dateTime('encoder_verification_expires_at')->nullable();
            $table->dateTime('encoder_verified_at')->nullable();
            $table->string('encoder_token')->nullable();
            $table->dateTime('encoder_token_expiration')->nullable();
            $table->tinyInteger('encoder_is_approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encoder');
    }
};
