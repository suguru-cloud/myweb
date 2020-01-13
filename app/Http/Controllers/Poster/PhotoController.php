<?php

namespace App\Http\Controllers\Poster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//以下を追記
use Illuminate\Support\Facades\Auth;

//以下を追加することでPhoto Modelが扱えるようになる
use App\Photo;

//以下を追加することでProgram Modelが扱えるようになる
use App\Program;

//画像の保存をS3にする
use Storage;

class PhotoController extends Controller
{
  public function create()
  {
    //Program Modelのデータを取得する
    $programs = Program::all();
    return view('poster.photos.create', ['programs' => $programs]);
  }
  
  public function store(Request $request)
  {
    //Varidationを行う
    request()->validate([
      'program_id' => 'required',
      'title' => 'required',
      'image_path1' => 'required',
    ],
    [ 'program_id.required' => '公演作品名を入力してください',
      'title.required' => '写真タイトルを入力してください',
      'image_path1.required' => '画像を選択してください'
    ]);

    $photos = new Photo;
    $form = $request->all();
    // 登録ユーザーからidを取得
    $photos->user_id = Auth::user()->id;
    
    // フォームから画像が送信されてきたら、保存して、$photos->image_path** に画像のパスを保存する
    //ここからS3に画像を保存するコード
    //画像をimage_path1に保存
    $path = Storage::disk('s3')->putFile('/',$form['image_path1'],'public');
    $programs->image_path1 = Storage::disk('s3')->url($path);

    //画像をimage_path2に保存
    if (isset($form['image_path2'])) {
      $path = Storage::disk('s3')->putFile('/',$form['image_path2'],'public');
      $programs->image_path2 = Storage::disk('s3')->url($path);
    } else {
        $programs->image_path2 = null;
    }
    
    //画像をimage_path3に保存
    if (isset($form['image_path3'])) {
      $path = Storage::disk('s3')->putFile('/',$form['image_path3'],'public');
      $programs->image_path3 = Storage::disk('s3')->url($path);
    } else {
        $programs->image_path3 = null;
    }
    
    /*ここからローカルに画像を保存するコード
    //画像をimage_path1に保存
    $path = $request->file('image_path1')->store('public/image');    
    $photos->image_path1 = basename($path);

    //画像をimage_path2に保存    
    if (isset($form['image_path2'])) {
      $path = $request->file('image_path2')->store('public/image');
      $photos->image_path2 = basename($path);
    } else {
        $photos->image_path2 = null;
    }

//画像をimage_path3に保存    
    if (isset($form['image_path3'])) {    
      $path = $request->file('image_path3')->store('public/image');    
    } else {
        $photos->image_path3 = null;
    }
ここまでローカルに画像を保存するコード*/

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image_path1']);
      unset($form['image_path2']);
      unset($form['image_path3']);

      //データベースに保存する
      $photos->fill($form);
      $photos->save();
      
      //登録後に poster/photos/storeにリダイレクトする
      return redirect('poster/photos');
  }

      //return view('poster.photos.create');
      
  public function index(Request $request)
  {

    $cond_title = $request->cond_title;
    if ($cond_title !='') {
      //検索されたら検索結果を取得する
      $posts = Photo::where('title', $cond_title)->get();
    } else {
      //それ以外はすべてを取得する
      $posts = Photo::all();
    }
    
    return view('poster.photos.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request)
  {
    // Photo Modelからデータを取得する
    $photos = Photo::find($request->id);
    
    if (empty($photos)) {
      abort(404);
    }
    //'post.photos.edit'に $photo_form という変数名で $photos という変数を渡す
    //'post.photos.edit'では {{ $photo_form }}と書く
    return view('poster.photos.edit', ['photo_form' => $photos]);
  }
  
  public function update(Request $request)
  {
   
    // Validationをかける
    request()->validate([
      //'program_id' => 'required',
      'title' => 'required',
      //'image_path1' => 'required',
    ],
    [ //'program_id.required' => '公演作品名を入力してください',
      'title.required' => '写真タイトルを入力してください',
      //'image_path1.required' => '画像を選択してください'
    ]);
    // Photo Modelからデータを取得する
    $photos = Photo::find($request->id);

    // 送信されてきたフォームデータを格納する
    $photo_form = $request->all();

    // 登録ユーザーからidを取得
    $photos->user_id = Auth::user()->id;

    //ここから画像をS3に保存するコード
    // image_path1 画像の保存
    if (isset($photo_form['image_path1'])) {
        $path = Storage::disk('s3')->putFile('/',$photo_form['image_path1'],'public');
        $photos->image_path1 = Storage::disk('s3')->url($path);
        unset($photo_form['image_path1']);
    } elseif (isset($request->remove)) {
        $photos->image_path1 = null;
        unset($photo_form['remove']);
    }

    // image_path2 画像の保存
    if (isset($photo_form['image_path2'])) {
        $path = Storage::disk('s3')->putFile('/',$photo_form['image_path2'],'public');
        $photos->image_path2 = Storage::disk('s3')->url($path);
        unset($photo_form['image_path2']);
    } elseif (isset($request->remove)) {
        $photos->image_path2 = null;
        unset($photo_form['remove']);
    }

    // image_path3 画像の保存
    if (isset($photo_form['image_path3'])) {
        $path = Storage::disk('s3')->putFile('/',$photo_form['image_path3'],'public');
        $photos->image_path3 = Storage::disk('s3')->url($path);
        unset($photo_form['image_path3']);
    } elseif (isset($request->remove)) {
        $photos->image_path3 = null;
        unset($photo_form['remove']);
    }

    /*ここからローカルに画像を保存するコード
    // image_path1 画像の保存
    if (isset($photo_form['image_path1'])) {
        $path = $request->file('image_path1')->store('public/image');
        $photos->image_path1 = basename($path);
        unset($photo_form['image_path1']);
    } elseif (isset($request->remove)) {
        $photos->image_path1 = null;
        unset($photo_form['remove']);
    }

    // image_path2 画像の保存
    if (isset($photo_form['image_path2'])) {
        $path = $request->file('image_path2')->store('public/image');
        $photos->image_path2 = basename($path);
        unset($photo_form['image_path2']);
    } elseif (isset($request->remove)) {
        $photos->image_path2 = null;
        unset($photo_form['remove']);
    }

    // image_path3 画像の保存    
    if (isset($photo_form['image_path3'])) {
        $path = $request->file('image_path3')->store('public/image');
        $photos->image_path3 = basename($path);
        unset($photo_form['image_path3']);
    } elseif (isset($request->remove)) {
        $photos->image_path3 = null;
        unset($photo_form['remove']);
    }
    ここまでローカルに画像を保存するコード*/

    unset($photo_form['_token']);

    //\Debugbar::info($photo_form);
    //該当するデータを上書きして保存する
    $photos->fill($photo_form)->save();

/*以下はうまく写真が更新されなかった書き方
    // Validationをかける
    request()->validate([
      //'program_id' => 'required',
      'title' => 'required',
      //'image_path1' => 'required',
    ],
    [ //'program_id.required' => '公演作品名を入力してください',
      'title.required' => '写真タイトルを入力してください',
      //'image_path1.required' => '画像を選択してください'
    ]);
    // Photo Modelからデータを取得する
    $photos = Photo::find($request->id);

    // 送信されてきたフォームデータを格納する
    $photo_form = $request->all();

    // 登録ユーザーからidを取得
    $photos->user_id = Auth::user()->id;

    // image_path1 画像の保存
    if ($request->remove1 == 'true') {
        $photo_form['image_path1'] = null;
    } elseif ($request->file('image_path1')) {
        $path = $request->file('image_path1')->store('public/image');
        $photo_form['image_path1'] = basename($path);
    }else {
        $photo_form['image_path1'] = $photos->image_path1;
    }
    
    // image_path2 画像の保存
    if ($request->remove2 == 'true') {
        $photo_form['image_path2'] = null;
    } elseif ($request->file('image_path2')) {
        $path = $request->file('image_path2')->store('public/image');
        $photo_form['image_path2'] = basename($path);
    }else {
        $photo_form['image_path2'] = $photos->image_path2;
    }    

    // image_path3 画像の保存    
    if ($request->remove3 == 'true') {
        $photo_form['image_path3'] = null;
    } elseif ($request->file('image_path3')) {
        $path = $request->file('image_path3')->store('public/image');
        $photo_form['image_path3'] = basename($path);
    }else {
        $photo_form['image_path3'] = $photos->image_path3;
    }    

    unset($photo_form['_token']);
    unset($photo_form['image_path1']);
    unset($photo_form['image_path2']);    
    unset($photo_form['image_path3']);    
    unset($photo_form['remove']);
    
    \Debugbar::info($photo_form);
    //該当するデータを上書きして保存する
    $photos->fill($photo_form)->save();
ここまでうまく写真が更新されなかった書き方*/
    
    return redirect('poster/photos');
  }



  
  public function delete(Request $request)
  {
    // 該当するPhoto Modelを取得
    $photos = Photo::find($request->id);
    //削除する
    $photos->delete();
    return redirect('poster/photos');
  }
}
