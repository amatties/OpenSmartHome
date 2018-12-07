<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = array('name', 'user_id');
   
    public function user() {
      return $this->belongsTo('App\User');
    }
}
