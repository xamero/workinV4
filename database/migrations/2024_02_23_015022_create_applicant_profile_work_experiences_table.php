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
        Schema::create('applicant_profile_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->integer('personal_profile_id');
            $table->string('company');
            $table->string('address');
            $table->string('position');
            $table->string('status');
            $table->date('date_started');
            $table->date('date_ended')->nullable();
            $table->text('job_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profile_work_experiences');
    }
};
