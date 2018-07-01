<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
        protected $fillable = array('name', 'pub_topic', 'sub_topic', 'ip');
        public $timestamps = false;
}
