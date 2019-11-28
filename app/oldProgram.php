<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  protected $guarded = array('id');
  
  //以下を追記
  public static $rules = array(
    'title' => 'required',
    'story' => 'required',
    'performancedates' => 'required',
    'releasedate' => 'required',
  );
  
  //belongsTo設定
  public function theaters()
  {
    
    return $this->belongsTo('App\Theater');
  }

}
