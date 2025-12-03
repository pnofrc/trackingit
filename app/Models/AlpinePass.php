<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlpinePass extends Model
{
    use HasFactory;
    
    // Il nome della tabella in PostgreSQL
    protected $table = 'alpine_passes';

    /**
     * I campi da includere nella creazione di massa (mass assignment).
     */
    protected $fillable = [
        'name',         // Mappa "Nome Valico Alpino"
        'latitude',
        'longitude',
        'rotation',
        'geojson', 
        'geom'          // Campo di geometria PostGIS
    ];
}