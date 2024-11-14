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
        Schema::create('quiz_assessments', function (Blueprint $table) {
            $table->id();
            $table->double('min');
            $table->double('max');
            $table->text('result');
            $table->text('advice')
                ->nullable();
            $table->text('message')
                ->nullable();
            $table->foreignUuid('question_type_id')
                ->references('id')
                ->on('question_types')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_assessments');
    }
};
