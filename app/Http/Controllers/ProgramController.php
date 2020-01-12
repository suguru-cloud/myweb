<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

//追記
use App\Program;

//追記
use App\Theater;

class ProgramController extends Controller
{
  public function index(Request $request)
  {
    $posts = Program::all();
    // programs/index.blade.php ファイルを渡している
    return view('programs.index', ['posts' => $posts]);
  }
}
