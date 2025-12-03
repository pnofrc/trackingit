<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoPort extends Model
{
    use HasFactory;
    
    protected $table = 'cargo_ports';

    /**
     * I campi da includere nella creazione di massa.
     */
    protected $fillable = [
        'idporto',
        'locode',
        'name',
        'importance',
        'geojson', 
        'geom'     
    ];
}