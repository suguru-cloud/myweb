<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

//追記
use App\Theater;

class TheaterController extends Controller
{
  public function index(Request $request)
  {
    $posts = Theater::all();
    // theaters/index.blade.php ファイルを渡している
    return view('theaters.index', ['posts' => $posts]);
  }
}
