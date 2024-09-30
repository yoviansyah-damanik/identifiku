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
        Schema::create('quiz_phase_details', function (Blueprint $table) {
            $table->foreignId('quiz_phase_id')
                ->references('id')
                ->on('quiz_phases');
            $table->foreignId('grade_level_id')
                ->references('id')
                ->on('grade_levels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_phase_details');
    }
};
