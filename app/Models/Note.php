<?php

namespace App\Models;

use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\hasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model implements CanVisit
{
    use HasFactory;
    use HasVisits;

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
