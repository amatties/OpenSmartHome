<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
   protected $fillable = array('name', 'datetime_init', 'datetime_end');
   public $timestamps = false;
}
