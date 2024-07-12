<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'news_type',
        'date',
        'city',
        'content',
        'picture',
        'external_link'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y', // Change your format
    ];
}
