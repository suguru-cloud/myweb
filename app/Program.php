<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  protected $guarded = array('id');
  //以下を追記
  public static $rule = array(
    'title' => 'required',
    'story' => 'required',
    'performancedates' => 'required',
    'releasedate' => 'required',
    );
    
  //belongTo設定
  public function theaters()
  {
    return $this->belongTo('App\Theater');
  }
  
}
