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
        Schema::create('meteo_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meteo_request_id')->references('id')->on('meteo_requests')->onDelete('cascade');
            $table->string('city');
            $table->string('temp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meteo_responses');
    }
};
