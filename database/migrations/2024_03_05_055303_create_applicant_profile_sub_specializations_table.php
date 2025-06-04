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
        Schema::create('applicant_profile_sub_specialization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained('applicant_profiles', 'id', 'profile_id');
            $table->foreignId('sub_specialization_id')->constrained('sub_specializations', 'id' ,'sub_specialization_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profile_sub_specialization');
    }
};
