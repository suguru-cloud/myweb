{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'劇場の登録'を埋め込む --}}
@section('title', '劇場の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>劇場登録</h2>
        <form action="{{ action('Admin\TheaterController@store') }}" method="post" enctype="multipart/form-data">
          
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
              <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="address">住所</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="address" value="{{ old('address') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="access">アクセス</label>
            <div class="col-md-10">
              <textarea class="form-control" name="access" rows="20">{{ old('access') }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image">
            </div>
          </div>
          {{ csrf_field() }}
          <input type="submit" class="btn btn-primary" value="登録">
        </form>
      </div>
    </div>
  </div>
@endsection