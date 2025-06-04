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
        Schema::create('applicant_profile_educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_profile_id');
            $table->integer('level');
            $table->string('school');
            $table->string('course')->nullable();
            $table->year('year_graduated')->nullable();
            $table->text('highlights')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profile_educational_backgrounds');
    }
};
