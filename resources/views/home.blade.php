@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div class="card-body">
                    <a href="{{ route('top') }}">TOP画面へ戻る</a>
                </div>

                {{-- ここからユーザーコンテンツ --}}
                @if ($user == 'user')
                <div class="card-header">ユーザーコンテンツ</div>
                
                <div class="card-body">
                    <a href="{{ url('poster/photos/create') }}">写真投稿</a>
                </div>
                <div class="card-body">
                    <a href="{{ url('poster/photos') }}">投稿一覧</a>
                </div>
                @endif
                {{-- ここまでユーザーコンテンツ --}}
                
                {{-- ここから管理者コンテンツ --}}
                @if ($user == 'admin')
                <div class="card-header">管理者コンテンツ</div>

                <div class="card-body">
                    <a href="{{ url('admin/theaters/create') }}">劇場登録</a>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/theaters') }}">登録劇場一覧</a>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/programs/create') }}">公演作品登録</a>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/programs') }}">登録公演作品一覧</a>
                </div>
                @endif
                {{-- ここまで管理者コンテンツ --}}

            </div>
        </div>
    </div>
</div>
@endsection
