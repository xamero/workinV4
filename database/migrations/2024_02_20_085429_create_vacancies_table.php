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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('title');
            $table->text('details');
            $table->integer('sub_specialization_id');
            $table->string('job_type');
            $table->string('location');
            $table->double('salary_from')->nullable();
            $table->double('salary_to')->nullable();
            $table->integer('total_vacancy')->nullable();
            $table->boolean('is_public')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('reason_of_delete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
