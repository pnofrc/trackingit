<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSllAreasTable extends Migration
{
    public function up()
    {
        Schema::create('sll_areas', function (Blueprint $table) {
            $table->id();
            $table->float('sll_2011');
            $table->json('geojson');
            $table->geometry('geom');  // Assuming PostGIS is properly configured
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sll_areas');
    }
}
