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
        Schema::dropIfExists('cargo_ports'); 
        
        // Abilita PostGIS (se non è già attivo)
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        Schema::create('cargo_ports', function (Blueprint $table) {
            $table->id();
            
            // Campi mappati dalle "properties"
            $table->integer('idporto');
            $table->string('locode', 5)->nullable();
            $table->string('name')->nullable(); // Mappa il campo "nome"
            $table->string('importance')->nullable(); // Mappa il campo "importante"

            // Dati GeoJSON completi
            $table->json('geojson');
            
            $table->timestamps();
        });
        
        // AGGIUNGI LA COLONNA SPAZIALE CON SQL GREZZO
        // Tipo: Point, SRID: 4326 (basato su CRS84)
        DB::statement('ALTER TABLE cargo_ports ADD COLUMN geom GEOMETRY(Point, 4326) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_ports');
    }
};