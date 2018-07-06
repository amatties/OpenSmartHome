<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
     protected $fillable = array('name', 'port', 'port_status', 'module_id');
    
    public $timestamps = false;

    
    public function module() {
      return $this->belongsTo('App\Module');
    }
    
    public function shedules() {

        return $this->belongsToMany('App\Schedule', 'schedule_device', 'schedule_id', 'device_id');
        
    }
}
