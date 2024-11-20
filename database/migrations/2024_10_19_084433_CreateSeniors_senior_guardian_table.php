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
        Schema::create('senior_guardian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_id')->nullable()->constrained('seniors');
            $table->string('guardian_first_name')->nullable();
            $table->string('guardian_middle_name')->nullable();
            $table->string('guardian_last_name')->nullable();
            $table->string('guardian_suffix')->nullable();
            $table->foreignId('guardian_relationship_id')->nullable()->constrained('relationship_list');
            $table->string('guardian_contact_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senior_guardian');
    }
};
