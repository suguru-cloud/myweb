@extends('layouts.admin')
@section('title', '登録済みの劇場一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <h2>劇場一覧</h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="{{ action('Admin\TheaterController@create') }}" role="button" class="btn btn-primary">新規作成</a>
      </div>
      <div class="col-md-8">
        <form action="{{ action('Admin\TheaterController@index') }}" method="get">
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
      <div class="list-theater col-md-12 mx-auto">
        <div class="row">
          <table class="table table-dark">
            <thead>
              <tr>
                <th width="10%">ID</th>
                <th width="20%">劇場名</th>
                <th width="20%">住所</th>
                <th width="40%">アクセス</th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $post)
                <tr>
                  <th>{{ $post->id }}</th>
                  <td>{{ \Str::limit($post->title, 100) }}</td>
                  <td>{{ \Str::limit($post->address, 250) }}</td>
                  <td>{{ \Str::limit($post->access, 100) }}</td>
                  <td>
                    <div>
                      <a href="{{ action('Admin\TheaterController@edit', ['id' => $post->id]) }}">編集</a>
                    </div>
                    <div>
                      <a href="{{ action('Admin\TheaterController@delete', ['id' => $post->id]) }}">削除</a>
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