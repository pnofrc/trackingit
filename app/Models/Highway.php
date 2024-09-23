<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highway extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'highway_code','geojson', 'geom'];
}
