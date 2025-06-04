<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_barangays', function (Blueprint $table) {
            $table->id();
            $table->integer('psgc_code');
            $table->string('name');
            $table->string('old_name')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('city_municipality_id')->constrained('address_city_municipalities');
            $table->string('fullname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_barangays');
    }
};
