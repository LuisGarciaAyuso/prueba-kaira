<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'url',
        'short_url',
        'created_at'
    ];
}
