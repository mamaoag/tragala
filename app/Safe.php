<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    protected $fillable = [
            'post_id', 'is_active',
    ];

}
