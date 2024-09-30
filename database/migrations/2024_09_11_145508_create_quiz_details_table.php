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
        Schema::create('quiz_details', function (Blueprint $table) {
            $table->foreignUuid('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');
            $table->foreignId('question_type_id')
                ->references('id')
                ->on('question_types')
                ->onDelete('cascade');
            $table->integer('priority')
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_details');
    }
};
