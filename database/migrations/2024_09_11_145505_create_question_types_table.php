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
        Schema::create('question_types', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('order')->default(0);
            $table->foreignUuid('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_types');
    }
};
