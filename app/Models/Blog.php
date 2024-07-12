<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'date',
        'content',
        'picture',
        'pdf'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y', // Change your format
    ];
}
