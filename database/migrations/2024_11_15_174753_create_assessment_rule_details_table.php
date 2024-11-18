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
        Schema::create('assessment_rule_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_rule_id')
                ->references('id')
                ->on('assessment_rules')
                ->onDelete('cascade');
            $table->text('indicator');
            $table->string('answer')->nullable();
            $table->integer('value_min')->nullable();
            $table->integer('value_max')->nullable();
            $table->varchar('score', 5)->nullable();
            $table->string('default')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_rule_details');
    }
};
