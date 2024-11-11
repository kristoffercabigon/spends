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
            $table->string('admin_first_name');
            $table->string('admin_middle_name')->nullable();
            $table->string('admin_last_name');
            $table->string('admin_suffix')->nullable();
            $table->string('admin_email');
            $table->string('admin_password');
            $table->string('admin_profile_picture')->nullable();
            $table->integer('admin_verification_code')->nullable();
            $table->dateTime('admin_verification_expires_at')->nullable();
            $table->dateTime('admin_verified_at')->nullable();
            $table->string('admin_token')->nullable();
            $table->dateTime('admin_token_expiration')->nullable();
            $table->tinyInteger('admin_is_approved')->default(0);
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
