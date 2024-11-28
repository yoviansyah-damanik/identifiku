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
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->foreignUuid('student_id')
                ->references('id')
                ->on('students');
            $table->foreignUuid('quiz_id')
                ->references('id')
                ->on('quizzes');
            $table->foreignUuid('student_class_id')
                ->references('id')
                ->on('student_classes');
            $table->timestamp('started_on')->nullable();
            $table->char('status', 1)
                ->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
