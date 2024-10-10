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
        Schema::create('school_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('npsn', 8);
            $table->char('nss', 12);
            $table->char('nis', 6);
            $table->string('address');
            $table->string('phone_number');
            $table->string('province_id');
            $table->foreign('province_id')
                ->references('code')
                ->on('regions');
            $table->string('regency_id');
            $table->foreign('regency_id')
                ->references('code')
                ->on('regions');
            $table->string('district_id');
            $table->foreign('district_id')
                ->references('code')
                ->on('regions');
            $table->string('village_id');
            $table->foreign('village_id')
                ->references('code')
                ->on('regions');
            $table->string('postal_code');
            $table->foreignId('school_status_id')
                ->references('id')
                ->on('school_statuses');
            $table->foreignId('education_level_id')
                ->references('id')
                ->on('education_levels');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_requests');
    }
};
