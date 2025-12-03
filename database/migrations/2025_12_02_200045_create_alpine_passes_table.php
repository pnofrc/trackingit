<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('alpine_passes'); 
        
        // Abilita PostGIS (se non è già attivo)
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        Schema::create('alpine_passes', function (Blueprint $table) {
            $table->id();
            
            // Campi mappati dalle "properties"
            $table->string('name')->nullable(); // Mappa "Nome Valico Alpino"
            $table->float('latitude')->nullable(); // Campo informativo
            $table->float('longitude')->nullable(); // Campo informativo
            $table->float('rotation')->nullable(); // Mappa "rotazione"

            // Dati GeoJSON completi
            $table->json('geojson');
            
            $table->timestamps();
        });
        
        // AGGIUNGI LA COLONNA SPAZIALE CON SQL GREZZO
        // Tipo: Point, SRID: 4326 (basato su CRS84 del dataset)
        DB::statement('ALTER TABLE alpine_passes ADD COLUMN geom GEOMETRY(Point, 4326) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alpine_passes');
    }
};