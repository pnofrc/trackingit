<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('cargo_airports'); 
        
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        Schema::create('cargo_airports', function (Blueprint $table) {
            $table->id();
            
            $table->string('airport_name')->nullable();
            $table->string('municipality')->nullable();
            $table->string('iata_code', 5)->nullable();
            $table->string('icao_code', 5)->nullable();
            $table->string('operator')->nullable();

            $table->json('geojson');
            
            $table->timestamps();
        });
        
        // CORREZIONE: Usa SQL grezzo per PostGIS
        DB::statement('ALTER TABLE cargo_airports ADD COLUMN geom GEOMETRY(Point, 4326) NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_airports');
    }
};