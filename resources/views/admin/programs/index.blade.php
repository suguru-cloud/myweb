@extends('layouts.admin')
@section('title', '登録済みの公演作品一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <h2>公演作品一覧</h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="{{ action('Admin\ProgramController@create') }}" role="button" class="btn btn-primary">新規作成</a>
      </div>
      <div class="col-md-8">
        <form action="{{ action('Admin\ProgramController@index') }}" method="get">
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
                <th width="10%">ID</th>
                <th width="20%">公演作品</th>
                <th width="20%">あらすじ</th>
                <th width="20%">公演日</th>
                <th width="10%">チケット発売日</th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $programs)
                <tr>
                  <th>{{ $programs->id }}</th>
                  <td>{{ \Str::limit($programs->title, 100) }}</td>
                  <td>{{ \Str::limit($programs->story, 250) }}</td>
                  <td>{{ \Str::limit($programs->performancedates, 100) }}</td>
                  <td>{{ \Str::limit($programs->releasedate, 100) }}</td>
                  <td>
                    <div>
                      <a href="{{ action('Admin\ProgramController@edit', ['id' => $programs->id]) }}">編集</a>
                    </div>
                    <div>
                      <a href="{{ action('Admin\ProgramsController@delete', ['id' => $programs->id]) }}">削除</a>
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