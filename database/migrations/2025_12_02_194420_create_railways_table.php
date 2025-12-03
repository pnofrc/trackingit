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
        // Rimuovi la tabella se esiste per rifarla, se necessario
        Schema::dropIfExists('railways'); 
        
        Schema::create('railways', function (Blueprint $table) {
            $table->id();
            
            // Campi mappati dalle "properties" del GeoJSON
            $table->string('name')->nullable();
            $table->string('railway_type')->nullable(); // Mappa a "railway"
            $table->string('usage')->nullable();
            $table->string('ref')->nullable();
            $table->string('maxspeed')->nullable();
            $table->string('operator')->nullable();

            // Dati GeoJSON completi (l'intera feature)
            $table->json('geojson');

            // Campo di geometria spaziale (MultiLineString in PostGIS, SRID 3857)
            // Uso il tipo 'geometry' generico, PostGIS lo gestirà con ST_GeomFromGeoJSON
            $table->geometry('geom'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('railways');
    }
};