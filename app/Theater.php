<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
  protected $guarded = array('id');

  //以下を追記
  public static $rules = array(
    'title' => 'required',
    'address' => 'required',
    'access' => 'required',
  );
  
  //以下を追記
  public function programs()
  {
    return $this->hasMany('App\Program');
  }
  
}
