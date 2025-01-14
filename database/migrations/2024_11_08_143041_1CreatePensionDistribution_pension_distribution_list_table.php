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
        Schema::create('pension_distribution_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained('barangay_list');
            $table->string('venue');
            $table->dateTime('date_of_distribution');
            $table->time('end_time');
            $table->foreignId('pension_user_type_id')->nullable()->constrained('user_type_list');
            $table->foreignId('pension_encoder_id')->nullable()->constrained('encoder');
            $table->foreignId('pension_admin_id')->nullable()->constrained('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pension_distribution_list');
    }
};
