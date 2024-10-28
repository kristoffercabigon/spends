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
        Schema::create('income_source', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_id')->nullable()->constrained('seniors');
            $table->foreignId('income_source_id')->nullable()->constrained('where_income_source_list');
            $table->string('other_income_source_remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_source');
    }
};
