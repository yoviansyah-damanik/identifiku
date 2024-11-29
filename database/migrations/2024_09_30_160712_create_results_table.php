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
        Schema::create('results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('assessment_id')
                ->references('id')
                ->on('assessments')
                ->onDelete('cascade');
            $table->text('conclusion')
                ->nullable();
            $table->text('advice')
                ->nullable();
            $table->text('message')
                ->nullable();
            $table->enum('status', ['process', 'done', 'failed']);
            $table->text('status_message')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
