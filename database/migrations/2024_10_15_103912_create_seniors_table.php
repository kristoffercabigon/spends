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
            $table->id();
            $table->string('osca_id');
            $table->string('ncsc_rrn')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('address');
            $table->foreignId('barangay_id')->constrained('barangay');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('birthplace');
            $table->foreignId('sex_id')->constrained('sex');
            $table->foreignId('civil_status_id')->constrained('civil_status');
            $table->string('contact_no');
            $table->string('valid_id')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('indigency')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->text('signature_data')->nullable();
            $table->foreignId('type_of_living_arrangement')->constrained('living_arrangement_list');
            $table->string('other_arrangement_remark')->nullable();
            $table->tinyInteger('pensioner')->default(0);
            $table->string('if_pensioner_yes')->nullable();
            $table->tinyInteger('permanent_source')->default(0);
            $table->string('if_permanent_yes')->nullable();
            $table->string('if_permanent_yes_income')->nullable();
            $table->tinyInteger('has_illness')->default(0);
            $table->string('if_illness_yes')->nullable();
            $table->integer('has_disability');
            $table->string('if_disability_yes')->nullable();
            $table->date('date_applied');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('is_approved')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('verified_at')->nullable();
            $table->string('token')->nullable();
            $table->string('expiration')->nullable();
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
