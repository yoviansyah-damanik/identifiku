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
        Schema::create('class_has_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('student_class_id')
                ->references('id')
                ->on('student_classes');
            $table->foreignUuid('quiz_id')
                ->references('id')
                ->on('quizzes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_has_quizzes');
    }
};
