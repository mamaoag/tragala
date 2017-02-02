<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{

    protected $with=[
        'user',
        'admin',
        #'location',
        'report'
    ];
    protected $fillable = [
        'user_id', 'action_code', 'admin_id', 'location_id', 'report_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\User','admin_id');
    }

    #public function location()
    # {
    #    return $this->belongsTo('App\Location','location_id');
    #}

    public function report()
    {
        return $this->belongsTo('App\Report','report_id');
    }
}
