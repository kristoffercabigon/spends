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
        Schema::create('seniors', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key called 'id'
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->foreignId('citizenship_id')->constrained('citizenship'); 
            $table->string('address');
            $table->foreignId('barangay_id')->constrained('barangay'); 
            $table->date('birthdate');
            $table->integer('age');
            $table->string('birthplace');
            $table->foreignId('sex_id')->constrained('sex'); 
            $table->foreignId('civil_status_id')->constrained('civil_status');
            $table->string('valid_id')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('indigency')->nullable();
            $table->string('signature')->nullable();
            $table->integer('regular_support');
            $table->integer('hospitalized_6');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seniors'); 
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
