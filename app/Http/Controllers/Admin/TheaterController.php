<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追加することでTheater Modelが扱えるようになる
use App\Theater;

//以下を追記
//use Storage;

class TheaterController extends Controller
{
    public function create()
    {
      return view('admin.theaters.create');
    }
    
    public function store(Request $request)
    {
      
      //以下を追記
      //Varidationを行う
      //$this->validate($request, Theater::$rules);
      request()->validate([
        'title' => 'required',
        'address' => 'required',
        'access' => 'required'
      ],
      [ 'title.required' => '劇場名を入力してください',
        'address.required' => '住所を入力してください',
        'access.required' => 'アクセスを入力してください'
      ]);
      
      $theaters = new Theater;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$theaters->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $theaters->image_path = basename($path);
        //$path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        //$news->image_path = Storage::disk('s3')->url($path);
      } else {
          $theaters->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $theaters->fill($form);
      $theaters->save();
      
      // admin/theaters/storeにリダイレクトする
      return redirect('admin/theaters');
    }
    
    //以下を追加
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Theater::where('title', $cond_title)->get();
      } else {
          // それ以外はすべての劇場情報を取得する
          $posts = Theater::all();
      }
      return view('admin.theaters.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    // 以下を追記
    
    public function edit(Request $request)
    {
      // Theater Modelからデータを取得する
      $theaters = Theater::find($request->id);
      if (empty($theaters)) {
        abort(404);
      }
      return view('admin.theaters.edit', ['theater_form' => $theaters]);
    }
    
    public function update(Request $request)
    {
      // Validationをかける
      request()->validate([
        'title' => 'required',
        'address' => 'required',
        'access' => 'required'
      ],
      [ 'title.required' => '劇場名を入力してください',
        'address.required' => '住所を入力してください',
        'access.required' => 'アクセスを入力してください'
      ]);

      // Theater Modelからデータを取得する
      $theaters = Theater::find($request->id);
      // 送信されてきたフォームデータを格納する
      $theater_form = $request->all();
      //if ($request->remove == 'true') {
          //$theater_form['image_path'] = null;
      //} elseif ($request->file('image')) {
          //$path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
          //$news_form['image_path'] = Storage::disk('s3')->url($path);
      //} else {
          //$news_form['image_path'] = $news->image_path;
      //}
      if ($request->remove == 'true') {
          $theater_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $theater_form['image_path'] = basename($path);
      } else {
          $theater_form['image_path'] = $theaters->image_path;
      }
      
      unset($theater_form['_token']);
      unset($theater_form['image']);
      unset($theater_form['remove']);
      
      // 該当するデータを上書きして保存する
      $theaters->fill($theater_form)->save();
      
      return redirect('admin/theaters');
      
    }
    
    // 以下を追記
    public function delete(Request $request)
    {
      // 該当するTheater Modelを取得
      $theaters = Theater::find($request->id);
      //削除する
      $theaters->delete();
      return redirect('admin/theaters');
    }
}
