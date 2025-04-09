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
            $table->string('osca_id')->unique();
            $table->string('ncsc_rrn')->unique();
            $table->foreignId('application_status_id')->constrained('senior_application_status_list');
            $table->foreignId('account_status_id')->nullable()->constrained('senior_account_status_list');
            $table->foreignId('user_type_id')->constrained('user_type_list');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('address');
            $table->foreignId('barangay_id')->constrained('barangay_list');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('birthplace');
            $table->foreignId('sex_id')->constrained('sex_list');
            $table->foreignId('civil_status_id')->constrained('civil_status_list');
            $table->string('contact_no');
            $table->string('valid_id')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('indigency')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('signature')->nullable();
            $table->text('signature_data')->nullable();
            $table->foreignId('type_of_living_arrangement')->constrained('living_arrangement_list');
            $table->string('other_arrangement_remark')->nullable();
            $table->tinyInteger('pensioner')->default(0);
            $table->foreignId('if_pensioner_yes')->nullable()->constrained('how_much_pension_list');
            $table->tinyInteger('permanent_source')->default(0);
            $table->foreignId('if_permanent_yes_income')->nullable()->constrained('how_much_income_list');
            $table->tinyInteger('has_illness')->default(0);
            $table->string('if_illness_yes')->nullable();
            $table->integer('has_disability');
            $table->string('if_disability_yes')->nullable();
            $table->date('date_applied');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verification_code')->nullable();
            $table->dateTime('verification_expires_at')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->string('token')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('expiration')->nullable();
            $table->tinyInteger('is_application_archived')->default(0);
            $table->tinyInteger('is_beneficiary_archived')->default(0);
            $table->foreignId('application_assistant_id')->nullable()->constrained('user_type_list');
            $table->foreignId('application_admin_id')->nullable()->constrained('admin');
            $table->foreignId('application_encoder_id')->nullable()->constrained('encoder');
            $table->string('application_assistant_name')->nullable();
            $table->foreignId('registration_assistant_id')->nullable()->constrained('user_type_list');
            $table->foreignId('registration_admin_id')->nullable()->constrained('admin');
            $table->foreignId('registration_encoder_id')->nullable()->constrained('encoder');
            $table->string('registration_assistant_name')->nullable();
            $table->date('date_approved')->nullable();
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
