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
        Schema::create('teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('nuptk', 16)
                ->nullable()
                ->unique();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->char('gender', 1);
            $table->string('address');
            $table->string('phone_number');
            $table->string('subject');
            $table->foreignUuid('school_id')
                ->references('id')
                ->on('schools');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
