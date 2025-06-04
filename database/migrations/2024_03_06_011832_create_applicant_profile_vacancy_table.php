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
        Schema::create('applicant_profile_vacancy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained('applicant_profiles');
            $table->foreignId('vacancy_id')->constrained('vacancies');
            $table->timestamp('applied_at')->useCurrent();
            $table->longText('cover_letter')->nullable();
            $table->longText('resume')->nullable();
            $table->string('access_code')->unique();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profile_vacancy');
    }
};
