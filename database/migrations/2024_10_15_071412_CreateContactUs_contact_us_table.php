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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->integer('message_type_id')->constrained('message_type_list');
            $table->tinyInteger('is_favorite')->default(0);
            $table->string('name');
            $table->string('sent_by_email')->nullable();
            $table->string('sent_to_email')->nullable();
            $table->string('sent_by_contact')->nullable();
            $table->string('sent_to_contact')->nullable();
            $table->text('subject');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
