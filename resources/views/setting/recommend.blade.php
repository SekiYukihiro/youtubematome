@extends('layouts.app')

@section('content')


    <div class="text-right">

        @if(Auth::user()->icon_image_url)
            <span width="80px" height="80px">
                <img class="rounded" src="{{ Storage::disk('s3')->url(Auth::user()->icon_image_url) }}" width="80px" height="80px">
            </span>
        @else
            <img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 80) }}" alt="">
        @endif

        {{ Auth::user()->name }}

    </div>


        @if(Auth::user()->channel_name)
            <div class="row">
                <h1 class="channel_name col-12 mt-3 mb-5">{{ Auth::user()->channel_name }}</h1>
            </div>
        @endif


    <section class="clearfix">

        <div class="semicolon">”</div>
        <h2 class="mt-5">オススメ動画登録</h2>

        {!! Form::open(['route'=>'movies.store']) !!}
            <div class="recommend_form form-group mt-5">

                {!! Form::label('url','オススメYouTube動画 "ID" を入力する',['class'=>'text-success']) !!}
                    <br>例）登録したいYouTube動画のURLが <span class="url">https://www.youtube.com/watch?v=-bNMq1Nxn5o なら</span>
                    <div>　　"v="の直後にある "<span class="text-success">-bNMq1Nxn5o</span>" を入力</div>

                {!! Form::text('url',null,['class'=>'form-control']) !!}
                    <div class="register_button">
                        {!! Form::submit('新規登録する？',['class'=> 'button btn btn-primary mt-3 mb-5']) !!}
                    </div>

            </div>
        {!! Form::close() !!}

    </section>



    <section class="clearfix">
        <div class="semicolon">”</div>
        <h2 class="mt-5">オススメ動画から選択→削除</h2>

        @include('movies.movies_select', ['user'=>$user,'movies' => $movies])
    </section>


<section class="clearfix">

        <div class="wrapper d-flex mx-auto">
            <div class="semicolon_link text-left d-inline-block">”</div>
        </div>

        <h2 class="link text-center mt-5">
            <a href="{{ route('channel',['id'=>Auth::id()])}}">お気に入りワード設定</a>
        </h2>

</section>


<section class="clearfix">

        <div class="wrapper d-flex mx-auto">
            <div class="semicolon_link text-left d-inline-block">”</div>
        </div>

        <h2 class="link text-center mt-5">
            <a href="{{ route('upload.get')}}">自分の動画を投稿する</a>
        </h2>

</section>


@endsection