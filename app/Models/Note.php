<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'image_path',
        'time_to_read',
        'is_published',
        'priority',

    ];

    public function comments()
{
    return $this->hasMany(Comment::class);
}
}
