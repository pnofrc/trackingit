<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interport extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'name' ,'geojson', 'geom'];

}
