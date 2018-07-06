<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    protected $fillable = array('name', 'port', 'port_status', 'module_id');
    
    public $timestamps = false;

    
    public function module() {
      return $this->belongsTo('App\Module');
    }
    
    public function shedules() {

        return $this->belongsToMany('App\Schedule', 'schedule_light', 'schedule_id', 'light_id');
        
    }
}
