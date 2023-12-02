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
        Schema::create('flight_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->references('id')->on('flights');
            $table->string('name');
            $table->string('photo');
            $table->enum('classSeate',['economy','firstClass','businessClass']);
            $table->string('airplanPolicies');
            $table->string('destination');
            $table->integer('tripNumber');
            $table->time('tripTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_details');
    }
};
