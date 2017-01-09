<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   public $with = ['user'];
   
   protected $fillable = [
       'user_id', 'category', 'title', 'description', 'filename'
   ];

   public function user()
   {
       return $this->belongsTo('App\User');
   }
}
