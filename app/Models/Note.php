<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'body',
        'image_path',
        'time_to_read',
        'is_published',
        'priority',

        ];
}
