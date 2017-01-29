<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $with = ['users','posts'];
    protected $fillable = [
        'post_id', 'user_id', 'type', 'status'
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function posts()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
