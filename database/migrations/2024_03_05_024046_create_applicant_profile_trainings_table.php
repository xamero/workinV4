
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
        Schema::create('applicant_profile_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained('applicant_profiles')->onDelete('cascade');
            $table->string('name');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('institution');
            $table->string('certificate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profile_trainings');
    }
};
