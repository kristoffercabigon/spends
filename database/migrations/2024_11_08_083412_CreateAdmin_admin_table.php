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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->foreignId('admin_user_type_id')->constrained('user_type_list');
            $table->string('admin_first_name');
            $table->string('admin_middle_name')->nullable();
            $table->string('admin_last_name');
            $table->string('admin_suffix')->nullable();
            $table->string('admin_email');
            $table->string('admin_password');
            $table->string('admin_profile_picture')->nullable();
            $table->string('admin_verification_code')->nullable();
            $table->dateTime('admin_verification_expires_at')->nullable();
            $table->dateTime('admin_verified_at')->nullable();
            $table->string('admin_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('admin_token_expiration')->nullable();
            $table->date('admin_date_registered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
