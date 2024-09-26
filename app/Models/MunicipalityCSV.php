<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipalityCSV extends Model
{
    use HasFactory;

    protected $table = 'municipality_csv';

    protected $fillable = [
        'title',
        'file',
        'content'
    ];
}
