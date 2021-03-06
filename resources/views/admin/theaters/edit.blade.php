@extends('layouts.admin')
@section('title', '劇場の編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>劇場編集</h2>
        <form action="{{ action('Admin\TheaterController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2" for="title">劇場名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="title" value="{{ $theater_form->title }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="address">住所</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="address" value="{{ $theater_form->address }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="access">アクセス</label>
            <div class="col-md-10">
              <textarea class="form-control" name="access" rows="20">{{ $theater_form->access }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="image">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image">
              <div class="form-text text-info">
                設定中: {{ $theater_form->image_path }}
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
              <input type="hidden" name="id" value="{{ $theater_form->id }}">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="更新">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection