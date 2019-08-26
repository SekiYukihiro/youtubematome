@extends('layouts.app')

@section('content')

    <div class="text-center">
        <h1 class="matome">YouTubeまとめ ×</h1>
        <h1 class="matome">コミュニケーション</h1>
        <img id="change" class="rounded img-fluid" src="storage/welcome_images/movie.jpg" style="width:700px; height:100px; object-fit:cover; object-position:0% 60%;">
    </div>
        <h2 class="col-sm-11 offset-sm-2 mt-5">ログイン</h2>
    <p class="col-sm-8 offset-sm-2">ログインすると、<br>あなたのチャンネル作成 ／ 動画登録 ／ チャンネルのフォロー　等ができるようになります。</p>

    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}

            <p class="mt-2">{!! link_to_route('signup.get','新規ユーザ登録する？') !!}</p>
        </div>
    </div>

@endsection
