<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = array('name', 'module_id');
    
    public $timestamps = false;
    public function module() {
      return $this->belongsTo('App\Module');
    }
}
