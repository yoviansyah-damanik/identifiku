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
        Schema::create('assessment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('assessment_id')
                ->references('id')
                ->on('assessments')
                ->onDelete('cascade');
            $table->foreignUuid('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');
            $table->foreignId('answer_choice_id')
                ->nullable()
                ->references('id')
                ->on('answer_choices')
                ->onDelete('cascade');
            $table->integer('value')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_details');
    }
};
