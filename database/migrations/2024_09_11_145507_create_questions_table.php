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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('question');
            $table->integer('order')
                ->default(0);
            $table->char('operator', 1)
                ->nullable();
            $table->integer('score')
                ->default(1);
            $table->foreignUuid('question_group_id')
                ->references('id')
                ->on('question_groups')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
