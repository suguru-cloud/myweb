<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追加することでProgram Modelが扱えるようになる
use App\Program;

//以下を追記
//use Storage;

class ProgramController extends Controller
{
    public function add()
    {
      return view('admin.program.create');
    }
    
    public function create(Request $request)
    {
      
      //以下を追記
      //Varidationを行う
      $this->validate($request, Program::$rules);
      $programs = new Program;
      $form = $request->all();
      
      //DBからtheater_idを取得??
      $theatertitles = DB::table('programs')->pluck('theater_id');
      
      // フォームから画像が送信されてきたら、保存して、$programs->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $programs->image_path = basename($path);
        //$path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        //$news->image_path = Storage::disk('s3')->url($path);
      } else {
          $programs->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $programs->fill($form);
      $programs->save();
      
      // admin/program/createにリダイレクトする
      return redirect('admin/program/create');
    }
    
    //以下を追加
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Program::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Program::all();
      }
      return view('admin.program.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    // 以下を追記
    
    public function edit(Request $request)
    {
      // Programs Modelからデータを取得する
      $programs = Program::find($request->id);
      if (empty($programs)) {
        abort(404);
      }
      return view('admin.program.edit', ['program_form' => $programs]);
    }
    
    public function update(Request $request)
    {
      // Validationをかける
      $this->validate($request, Program::$rules);
      // Program Modelからデータを取得する
      $programs = Program::find($request->id);
      // 送信されてきたフォームデータを格納する
      $program_form = $request->all();
      //if ($request->remove == 'true') {
          //$programs_form['image_path'] = null;
      //} elseif ($request->file('image')) {
          //$path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
          //$news_form['image_path'] = Storage::disk('s3')->url($path);
      //} else {
          //$news_form['image_path'] = $news->image_path;
      //}
      if ($request->remove == 'true') {
          $program_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $program_form['image_path'] = basename($path);
      } else {
          $program_form['image_path'] = $programs->image_path;
      }
      
      unset($program_form['_token']);
      unset($program_form['image']);
      unset($program_form['remove']);
      
      // 該当するデータを上書きして保存する
      $programs->fill($program_form)->save();
      
      return redirect('admin/program/');
      
    }
    
    // 以下を追記
    public function delete(Request $request)
    {
      // 該当するProgram Modelを取得
      $programs = Program::find($request->id);
      //削除する
      $programs->delete();
      return redirect('admin/program/');
    }
}
