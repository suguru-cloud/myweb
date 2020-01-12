@extends('layouts.admin')
@section('title', '登録済みの投稿写真一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <h2>投稿写真一覧</h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="{{ action('Poster\PhotoController@create') }}" role="button" class="btn btn-primary">新規作成</a>
      </div>
      <div class="col-md-8">
        <form action="{{ action('Poster\PhotoController@index') }}" method="get">
          <div class="form-group row">
            <label class="col-md-2">キーワード</label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
            </div>
            <div class="col-md-2">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="検索">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="admin-news col-md-12 mx-auto">
        <div class="row">
          <table class="table table-dark">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="10%">公演作品名</th>
                <th width="10%">user ID</th>
                <th width="40%">タイトル</th>
                <th width="20%">投稿日</th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $post)
                <tr>
                  <th>{{ $post->id }}</th>
                  <td>{{ $post->program->title }}</td>
                  <td>{{ $post->user_id }}</td>
                  <td>{{ \Str::limit($post->title, 100) }}</td>
                  <td>{{ $post->updated_at->format('Y年m月d日') }}</td>
                  <td>
                    <div>
                      <a href="{{ action('Poster\PhotoController@edit', ['id' => $post->id]) }}">編集</a>
                    </div>
                    <div>
                      <a href="{{ action('Poster\PhotoController@delete', ['id' => $post->id]) }}">削除</a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection