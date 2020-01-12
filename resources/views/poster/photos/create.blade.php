{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'公演作品の登録'を埋め込む --}}
@section('title', '作品写真の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>写真登録</h2>
        <form action="{{ action('Poster\PhotoController@store') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
          @endif
            </ul>
          <div class="form-group row">
            <label class="col-md-2">公演作品名</label>
            <div class="col-md-10">
              <select class="form-control" id="program_id" name="program_id">
                @foreach($programs as $program)
                <option value="{{ $program->id }}">{{$program->title}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">タイトル</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-ms-10">
              <input type="file" class="form-control-file" name="image_path1">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-ms-10">
              <input type="file" class="form-control-file" name="image_path2">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-ms-10">
              <input type="file" class="form-control-file" name="image_path3">
            </div>
          </div>
          {{ csrf_field() }}
          <input type="submit" class="btn btn-primary" value="投稿">
        </form>
      </div>
    </div>
  </div>
@endsection