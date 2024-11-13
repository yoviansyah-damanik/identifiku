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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->integer('estimation_time');
            $table->text('content_coverage');
            $table->text('assessment_objectives');
            $table->text('question_composition');
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('quiz_category_id')
                ->references('id')
                ->on('quiz_categories');
            $table->foreignId('quiz_phase_id')
                ->references('id')
                ->on('quiz_phases');
            $table->boolean('is_active')->default(false);
            $table->string('type');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
