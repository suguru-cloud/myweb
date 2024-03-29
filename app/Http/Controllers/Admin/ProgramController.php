<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追加することでProgram Modelが扱えるようになる
use App\Program;

// 以下を追加することでTheater Modelが扱えるようになる
use App\Theater;

//画像の保存をS3にする
use Storage;

class ProgramController extends Controller
{
    public function create()
    {
      //以下の書き方はDBにアクセスする書き方。LaravelではModelを使用してアクセスするため下記は使用しない
      //$titles = DB::table('theaters')->select('id', 'title');     
      //Theater Modelのデータを取得する
      $theaters = Theater::all();
      return view('admin.programs.create', ['theaters' => $theaters]);
    }
    
    public function store(Request $request)
    {
      //以下を追記
      //Varidationを行う
      //$this->validate($request, Program::$rules);
      request()->validate([
        'theater_id' => 'required',
        'title' => 'required',
        'story' => 'required',
        'performancedates' => 'required',
        'releasedate' => 'required',
      ],
      [ 'theater_id.required' => '劇場名を入力してください',
        'title.required' => '公演作品名を入力してください',
        'story.required' => 'あらすじを入力してください',
        'performancedates.required' => '公演日を入力してください',
        'releasedate.required' => 'チケット発売日を入力してください'
      ]);

      $programs = new Program;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$programs->image_path に画像のパスを保存する
        /*ここからローカルに画像を保存するコード
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $programs->image_path = basename($path);
      } else {
          $programs->image_path = null;
      }
        ここまでローカルに画像を保存するコード*/

      //ここからS3に画像を保存するコード
      if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $programs->image_path = Storage::disk('s3')->url($path);
      } else {
          $programs->image_path = null;
      }
      //ここまでS3に画像を保存するコード
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $programs->fill($form);
      $programs->save();
      
      // admin/programs/storeにリダイレクトする
      return redirect('admin/programs');
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
      return view('admin.programs.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    // 以下を追記
    
    public function edit(Request $request)
    {
      // Programs Modelからデータを取得する
      $programs = Program::find($request->id);
      if (empty($programs)) {
        abort(404);
      }
      return view('admin.programs.edit', ['program_form' => $programs]);
    }
    
    public function update(Request $request)
    {
      // Validationをかける
      request()->validate([
        'title' => 'required',
        'story' => 'required',
        'performancedates' => 'required',
        'releasedate' => 'required',
      ],
      [ //'theater_id.required' => '劇場名を入力してください',
        'title.required' => '公演作品名を入力してください',
        'story.required' => 'あらすじを入力してください',
        'performancedates.required' => '公演日を入力してください',
        'releasedate.required' => 'チケット発売日を入力してください'
      ]);        
      
      // Program Modelからデータを取得する
      $programs = Program::find($request->id);
      
      // 送信されてきたフォームデータを格納する
      $program_form = $request->all();
      
      //ここから画像をS3に保存するコード
      if ($request->remove == 'true') {
          $program_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = Storage::disk('s3')->putFile('/',$program_form['image'],'public');
          $program_form['image_path'] = Storage::disk('s3')->url($path);
      } else {
          $program_form['image_path'] = $programs->image_path;
      }
      //ここまで画像をS3に保存するコード
      
      /*ここから画像をローカル保存するコード
      if ($request->remove == 'true') {
          $program_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $program_form['image_path'] = basename($path);
      } else {
          $program_form['image_path'] = $programs->image_path;
      }
      ここまで画像をローカルに保存するコード*/
      
      unset($program_form['_token']);
      unset($program_form['image']);
      unset($program_form['remove']);
      
      // 該当するデータを上書きして保存する
      $programs->fill($program_form)->save();
      
      return redirect('admin/programs');
      
    }
    
    // 以下を追記
    public function delete(Request $request)
    {
      // 該当するProgram Modelを取得
      $programs = Program::find($request->id);
      //削除する
      $programs->delete();
      return redirect('admin/programs');
    }
}
