<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoJsonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geojson_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('geojson'); // Store GeoJSON data
            $table->timestamps();
            $table->geometry('geom', 'Geometry', 4326); // Spatial column with PostGIS
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geojson_data');
    }
}
