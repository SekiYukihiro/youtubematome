@extends('layouts.app')

@section('content')
        <li class="media">
            <a href="{{ route('users.show',['id'=>Auth::id()]) }}"><img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 50) }}" alt=""></a>
                <div class="media-body">
                    <div>
                        {{ Auth::user()->name }}
                    </div>
                </div>
        </li>
        <h1>{{ Auth::user()->channel_name }} のチャンネル設定</h1>

        <h2 class="mt-5">表示名</h2>

        {!! Form::model($user,['route'=>['rename',$user->id],'method'=>'put']) !!}

                <div class="form-group">
                        {!! Form::label('channel_name','チャンネル名') !!}
                        {!! Form::text('channel_name',old('channel_name'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('name','名前') !!}
                        {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}

        <h2 class="mt-5">お気に入りワードを設定</h2>

        <p>現在のお気に入りワード："{{ Auth::user()->favorite_word }}"</p>

        {!! Form::open(['route'=>'word.store']) !!}
                <div class="form-group">
                        {!! Form::label('favorite_word','お気に入りワードを入力') !!}
                        {!! Form::text('favorite_word',old('favorite_word'),['class'=>'form-control']) !!}
                </div>
                        {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}

        <figure class="mt-5">
                <img class="rounded img-fluid" src="{{ Storage::url(Auth::user()->icon_image_url) }}" width="100px" height="100px">
                <figcaption>現在のプロフィール画像</figcaption>
        </figure>

        <form method="POST" action="/storeIcon" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="photo" class="btn btn-lg">
                <input type="submit" class="btn btn-primary btn-lg d-block ml-3">
        </form>

        <h2 class="mt-5">詳細プロフィール</h2>

        {!! Form::model($user,['route'=>['profile',$user->id],'method'=>'put']) !!}

                <div class="form-group">
                        {!! Form::label('email','メールアドレス') !!}
                        {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('password','パスワード') !!}
                        {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('password_confirmation','パスワード確認') !!}
                        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}

        <h2 class="mt-5">チャンネル・ユーザ退会</h2>

        {!! Form::model($user,['route'=>['users.delete',$user->id],'method'=>'delete']) !!}
                {!! Form::submit('退会する？',['class'=>'btn btn-danger btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}


@endsection