<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalitiesTable extends Migration
{
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->integer('region_code');
            $table->integer('province_code');
            $table->integer('municipality_code');
            $table->json('geojson');
            $table->geometry('geom');  // Assuming PostGIS is properly configured
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
