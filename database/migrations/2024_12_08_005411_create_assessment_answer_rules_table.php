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
        Schema::create('assessment_answer_rules', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->integer('score')
                ->nullable();
            $table->string('default')->nullable();
            $table->foreignId('assessment_rule_id')
                ->references('id')
                ->on('assessment_rules')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_answer_rules');
    }
};
