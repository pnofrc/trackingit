<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Railway extends Model
{
    use HasFactory;

    /**
     * I campi da includere nella creazione di massa.
     */
    protected $fillable = [
        'name',
        'railway_type',
        'usage',
        'ref',
        'maxspeed',
        'operator',
        'geojson', // GeoJSON completo
        'geom'     // Geometria PostGIS
    ];
}