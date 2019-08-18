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
        <h1>{{ Auth::user()->channel_name }}</h1>

        <h2>オススメ動画登録</h2>

        {!! Form::open(['route'=>'movies.store']) !!}
                <div class="form-group">
                        {!! Form::label('url','オススメ動画（YouTube）のURL') !!}
                        {!! Form::text('url',null,['class'=>'form-control']) !!}

                        {!! Form::submit('新規登録する？',['class'=> 'btn btn-primary']) !!}
                </div>
        {!! Form::close() !!}

        <h2>動画をオススメから削除</h2>
        @include('movies.movies_select', ['user'=>$user,'movies' => $movies])

        <a href="{{ route('channel',['id'=>Auth::id()])}}"><h2 class="mt-5">お気に入りワードを設定</h2></a>

        <a href="{{ route('upload.get')}}"><h2 class="mt-5">自分の動画を投稿する</h2></a>

@endsection