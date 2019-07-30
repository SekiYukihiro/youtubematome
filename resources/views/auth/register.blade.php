@extends('layouts.app')

@section('content')

    <div class="text-center">
        <h1>YouTubeまとめ×コミュニケーション</h1>
    </div>
        <h2 class="col-sm-11 offset-sm-2">新規ユーザ登録</h2>
    <p class="col-sm-8 offset-sm-2">ユーザ登録すると、<br>あなたのチャンネル作成 ／ 動画登録 ／ チャンネルのフォロー　等ができるようになります。</p>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('新規登録', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

            <p class="mt-2">{!! link_to_route('login','登録済みの方はコチラ') !!}</p>
        </div>
    </div>

@endsection