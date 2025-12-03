<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoAirport extends Model
{
    use HasFactory;

    /**
     * I campi da includere nella creazione di massa.
     */
    protected $fillable = [
        'airport_name',
        'municipality',
        'iata_code',
        'icao_code',
        'operator',
        'geojson', 
        'geom'     
    ];
}