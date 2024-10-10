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
        Schema::create('student_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')
                ->nullable();
            $table->string('nis');
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->char('gender', 1);
            $table->string('address');
            $table->string('phone_number');
            $table->foreignUuid('school_id')
                ->references('id')
                ->on('schools');
            $table->foreignId('grade_level_id')
                ->references('id')
                ->on('grade_levels');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_requests');
    }
};
