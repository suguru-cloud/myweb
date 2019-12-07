@extends('layouts.admin')
@section('title', '公演作品の編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>公演作品編集</h2>
        <form action="{{ action('Admin\ProgramController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2" for="title">公演作品</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="title" value="{{ $program_form->title }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="story">あらすじ</label>
            <div class="col-md-10">
              <textarea class="form-control" name="story" rows="20">{{ $program_form->story }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="performancedates">公演日</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="performancedates" value="{{ $program_form->story }}">
            </div>
          </div>
                <div class="form-group row">
            <label class="col-md-2" for="releasedate">チケット発売日</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="releasedate" value="{{ $program_form->releasedate }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="image">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image">
              <div class="form-text text-info">
                設定中: {{ $program_form->image_path }}
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
              <input type="hidden" name="id" value="{{ $program_form->id }}">
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