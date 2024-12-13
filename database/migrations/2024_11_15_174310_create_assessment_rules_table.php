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
        Schema::create('assessment_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');
            $table->string('type');
            $table->string('question_type');
            $table->integer('max_indicator')
                ->default(0);
            $table->integer('max_answer')
                ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_rules');
    }
};
