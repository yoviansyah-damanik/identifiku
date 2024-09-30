<?php

use App\Enums\Genders;
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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('nisn')
                ->unique()
                ->nullable();
            $table->string('local_nis')
                ->unique();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->char('gender', 1);
            $table->string('address');
            $table->string('phone_number');
            $table->foreignUuid('school_id')
                ->references('id')
                ->on('schools');
            $table->foreignId('grade_level_id')
                ->references('id')
                ->on('grade_levels');
            $table->enum('status', ['']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
