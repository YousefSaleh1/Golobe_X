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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('rate');
            $table->integer('priceForNight');
            $table->string('city');
            $table->string('address');
            $table->string('image');
            $table->enum('freebies',['free breakfast','free parking','free internet','free airport shuttle','free cancellation']);
            $table->enum('amenities',['24hr front desk','air-conditioned','fitness','pool','outdoor pool','indoor pool','restaurant','room service','fitness center','free wifi']);
            $table->string('overview');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
