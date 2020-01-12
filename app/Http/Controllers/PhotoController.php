<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Photo;

use App\Program;

class PhotoController extends Controller
{
  public function index(Request $request)
  {
    $posts = Photo::all();
    
    // photos/index.blade.php ファイルを渡している
    return view('photos.index', ['posts' => $posts]);
  }
}
