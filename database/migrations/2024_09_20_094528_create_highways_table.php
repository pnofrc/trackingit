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
        Schema::create('highways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('highway_code')->nullable();
            $table->json('geojson');
            $table->geometry('geom');  // Assuming PostGIS is properly configured
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highways');
    }
};
