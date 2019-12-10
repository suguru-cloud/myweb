{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'公演作品の登録'を埋め込む --}}
@section('title', '公演作品の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>公演作品登録</h2>
        <form action="{{ action('Admin\ProgramController@create') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2">劇場名</label>
            <div class="col-md-10">
              <select class="form-control" id="name" name="name">
                @foreach($titles as $title => $name)
                <option value="{{ $title }}">{{$name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">公演作品名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="story">あらすじ</label>
            <div class="col-md-10">
              <textarea class="form-control" name="story" rows="20">{{ old('story') }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="performancedates">公演日</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="performancedates" value="{{ old('performancedates') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="releasedate">チケット発売日</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="releasedate" value="{{ old('releasedate') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              {{-- <input type="hidden" name="id" value="{{ $program_form->theater_id }}"> --}}
          {{ csrf_field() }}
          <input type="submit" class="btn btn-primary" value="登録">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection