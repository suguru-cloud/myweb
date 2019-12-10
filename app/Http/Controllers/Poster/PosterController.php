<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosterController extends Controller
{
  public function add()
  {
    return view('poster.create');
  }
  
  public function create(Request $request)
  {
    // フォームから画像が送信されてきたら、保存して、$programs->image_path に画像のパスを保存する
    if (isset($form['image'])) {
      $path = $request->file('image')->store('public/image');
      $posts->image_path = basename($path);
    
      return redirect('poster/create')->with(['success'=> 'ファイルを保存しました']);
  }
  
  return view('poster.create');
  
  }
  
  
}
