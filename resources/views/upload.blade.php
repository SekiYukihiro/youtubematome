@extends('layouts.app')

@section('content')

@php
            $api = "AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw";
            $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=&key=$api&part=snippet,contentDetails,statistics,status";
            $json = @file_get_contents($get_api_url);
@endphp

    <div class="text-right">
            @if(Auth::user()->icon_image_url)
                <img class="rounded img-fluid" src="{{ Storage::url(Auth::user()->icon_image_url) }}" width="80px" height="80px">
            @else
                <img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 80) }}" alt="">
            @endif
                        {{ Auth::user()->name }}
    </div>

        @if(Auth::user()->channel_name)
            <div class="row">
                <h1 class="channel_name mt-3 mb-5 col-12">{{ Auth::user()->channel_name }}</h1>
            </div>
        @endif

<section class="clearfix">
    <div class="semicolon">”</div>
    <h2 class="mt-5 mb-5">自分の動画をYouTubeに投稿して登録する</h2>

    @if($json)
    <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data" files="true">
        <div class="form-group">
            <label class="d-block" for="exampleInputVideo">投稿したい動画を選択</label>
            <input type="file" name="video" id="exampleInputVideo" />
        </div>
    {{ csrf_field() }}
        <div class="form-group">
            {!! Form::label('title','動画タイトル') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description','YouTube動画説明文（概要欄）') !!}
            {!! Form::text('description',null,['class'=>'form-control']) !!}
        </div>
        <div class="register_button">
            {!! Form::submit('新規登録する？',['class'=> 'button btn btn-primary mt-3 mb-5']) !!}
        </div>
    </form>

    @else
    <h5>※現在一時的な情報制限中につき、YouTubeへの動画投稿ができません</h5>
    <h5 class="mb-5"><br></h5>
    @endif
</section>

<section class="clearfix">
    <div class="semicolon">”</div>
    <h2 class="mt-5">{{ $user->name }} 投稿動画</h2>

    @include('movies.movies_all', ['user'=>$user,'movies' => $movies])

</section>

@endsection