<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
  //以下を追記
  protected $guarded = array('id');
  
  //belongsTo設定
  public function program()
  {
    return $this->belongsTo('App\Program');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}