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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_profile_id');
            $table->foreign('applicant_profile_id')->references('id')->on('applicant_profiles')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('vacancy_id');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')
                ->restrictOnDelete()->restrictOnUpdate();
            $table->timestamp('date_applied');
            $table->longText('application_letter')->nullable();
            $table->string('resume')->nullable();
            $table->string('access_code');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
