@extends('layouts.admin')
@section('title', '投稿写真の編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>投稿写真編集</h2>
        <form action="{{ action('Poster\PhotoController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2" for="title">タイトル</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="title" value="{{ $photo_form->title }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image_path1">
              <div class="form-text text-info">
                設定中: {{ $photo_form->image_path1 }}
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                </label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image_path2">
              <div class="form-text text-info">
                設定中: {{ $photo_form->image_path2 }}
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                </label>
              </div>
            </div>
          </div>
           <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image_path3">
              <div class="form-text text-info">
                設定中: {{ $photo_form->image_path3 }}
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                </label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <input type="hidden" name="id" value="{{ $photo_form->id }}">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="更新">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection