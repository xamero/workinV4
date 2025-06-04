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
        Schema::create('applicant_profile_license_eligibilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_profile_id');
            $table->foreign('applicant_profile_id', 'applicant_profile_id')->references('id')->on('applicant_profiles')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('issuer')->nullable();
            $table->date('date_of_issuance')->nullable();
            $table->date('date_of_expiration')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profile_license_eligibilities');
    }
};
