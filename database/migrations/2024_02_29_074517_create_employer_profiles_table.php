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
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id', 'user_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id', 'company_id')->nullable()->constrained()
                ->nullOnDelete()->cascadeOnUpdate();
            $table->string('employer_id')->unique();
            $table->string('prefix')->nullable();
            $table->string('firstname');
            $table->string('surname');
            $table->string('position');
            $table->string('contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};
