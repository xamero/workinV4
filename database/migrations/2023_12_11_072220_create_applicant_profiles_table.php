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
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('firstname');
            $table->string('midname')->nullable();
            $table->string('surname');
            $table->string('suffix')->nullable();
            $table->integer('barangay_id');
            $table->integer('city_id');
            $table->string('current_barangay')->nullable();
            $table->string('current_city')->nullable();
            $table->string('current_province')->nullable();
            $table->date('birthday');
            $table->string('place_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('religion')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('disability')->nullable();
            $table->string('employment_status');
            $table->string('profile_picture')->nullable();
            $table->text('introduction')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profiles');
    }
};
