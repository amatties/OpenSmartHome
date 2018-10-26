<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor_Data extends Model
{
   public $table = "sensor_datas";
   protected $fillable = array('data', 'sensor_id');
    
    
    public function sensor() {
      return $this->belongsTo('App\Sensor');
    }
}
