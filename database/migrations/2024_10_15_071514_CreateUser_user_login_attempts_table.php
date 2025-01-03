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
        Schema::create('user_login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->foreignId('user_type_id')->nullable()->constrained('user_type_list');
            $table->string('status');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_login_attempts');
    }
};
