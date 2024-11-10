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
            $table->string('text');
            $table->string('type');
            $table->foreignId('question_group_id')
                ->references('id')
                ->on('question_groups')
                ->onDelete('cascade');
            $table->enum('time_unit', ['sec', 'min']);
            $table->integer('priority')
                ->default(0);
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
