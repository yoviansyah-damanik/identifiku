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
        Schema::create('answer_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');
            $table->string('text');
            $table->integer('value')
                ->nullable();
            $table->boolean('is_correct')
                ->nullable();
            $table->integer('order')
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_choices');
    }
};
