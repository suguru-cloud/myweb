{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'公演作品の登録'を埋め込む --}}
@section('title', '公演作品の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md mx-auto">
        <h2>写真登録</h2>
        <form action="{{ action('Poster\PhotoController@create') }}" method="post" enctype="multipart/form-data">
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-ms-10">
              <input type="file" class="form-control-file" name="image">
            </div>
          </div>
          {{-- {{ csrf_field() }} --}}
          <input type="submit" class="btn btn-primary" value="投稿">
        </form>
      </div>
    </div>
  </div>
@endsection