<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Url extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'url',
        'short_url',
        'created_at'
    ];
}
