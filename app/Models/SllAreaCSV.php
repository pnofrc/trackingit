<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SllAreaCSV extends Model
{
    use HasFactory;
    protected $table = 'sllarea_csv';
    protected $fillable = [
       'title',
       'file',
       'content'
    ];
}
