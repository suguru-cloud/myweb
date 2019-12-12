<?php

namespace App\Http\Controllers\Poster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotoController extends Controller
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
      $photos->image_path = basename($path);
    
      return redirect('poster/photo/create')->with(['success'=> 'ファイルを保存しました']);
  }
  
  return view('poster.create');
  
  }
}
