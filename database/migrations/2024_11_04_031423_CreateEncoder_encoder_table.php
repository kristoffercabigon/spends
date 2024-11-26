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
            $table->integer('encoder_id');
            $table->foreignId('encoder_user_type_id')->constrained('user_type_list');
            $table->string('encoder_first_name');
            $table->string('encoder_middle_name')->nullable();
            $table->string('encoder_last_name');
            $table->string('encoder_address');
            $table->foreignId('encoder_barangay_id')->constrained('barangay_list');
            $table->string('encoder_contact_no');
            $table->string('encoder_suffix')->nullable();
            $table->string('encoder_email');
            $table->string('encoder_password');
            $table->string('encoder_profile_picture')->nullable();
            $table->string('encoder_verification_code')->nullable();
            $table->dateTime('encoder_verification_expires_at')->nullable();
            $table->dateTime('encoder_verified_at')->nullable();
            $table->string('encoder_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('encoder_token_expiration')->nullable();
            $table->date('encoder_date_registered');
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
