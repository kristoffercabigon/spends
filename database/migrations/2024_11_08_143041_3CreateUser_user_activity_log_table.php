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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('activity');
            $table->foreignId('activity_type_id')->constrained('activity_types');
            $table->text('changes')->nullable();
            $table->string('status');
            $table->foreignId('activity_user_type_id')->constrained('user_type_list');
            $table->foreignId('activity_encoder_id')->nullable()->constrained('encoder');
            $table->foreignId('activity_admin_id')->nullable()->constrained('admin');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
