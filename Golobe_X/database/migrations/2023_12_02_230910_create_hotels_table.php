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
            $table->enum('rate',['1','2','3','4','5']);
            $table->double('priceForNight');
            $table->string('city');
            $table->string('address');
            $table->string('image');
            // $table->json('freebies');
            $table->enum('freebies' , ['free breakfast','free parking','free internet','free airport shuttle','free cancellation']);
            // $table->json('amenities');
            $table->enum('amenities' , ['24hr front desk','air-conditioned','fitness','pool','outdoor pool','indoor pool','restaurant','room service','fitness center','free wifi']);
            $table->string('overview');
            $table->softDeletes();
            $table->timestamps();
        });
    }
//,['free breakfast','free parking','free internet','free airport shuttle','free cancellation']);
//,['24hr front desk','air-conditioned','fitness','pool','outdoor pool','indoor pool','restaurant','room service','fitness center','free wifi']);
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
