<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoJsonData extends Model
{
    protected $table = 'geojson_data';

    protected $fillable = [
        'name',
        'geojson',
        'geom', // Ensure geom is included if you want to manage it directly
    ];
}
