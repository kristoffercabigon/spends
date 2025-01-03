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
        Schema::create('events_list', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('event_date');
            $table->string('video')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->foreignId('barangay_id')->constrained('barangay_list');
            $table->foreignId('event_user_type_id')->nullable()->constrained('user_type_list');
            $table->foreignId('event_encoder_id')->nullable()->constrained('encoder');
            $table->foreignId('event_admin_id')->nullable()->constrained('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_list');
    }
};
