<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  protected $guarded = array('id');
  //以下を追記
  //public static $rule = array(
    //'theater_id' => 'required',
    //'title' => 'required',
    //'story' => 'required',
    //'performancedates' => 'required',
    //'releasedate' => 'required',
    //);
    
  //belongsTo設定
  public function theater()
  {
    return $this->belongsTo('App\Theater');
  }
  
  public function photos()
  {
    return $this->hasMany('App\Photo');
  }
  
}
