@extends('layouts.app')

@section('content')
    <li class="media">
            @if($user->icon_image_url)
                <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="50px" height="50px">
            @else
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
            @endif
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                </div>
    </li>

    <h1>{{ $user->channel_name }}</h1>

    <h2>自分の動画を投稿する</h2>


    <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data" files="true">
        <div class="form-group">
            <label class="d-block" for="exampleInputVideo">投稿動画</label>
            <input type="file" name="video" id="exampleInputVideo" />
        </div>
    {{ csrf_field() }}
        <div class="form-group">
            {!! Form::label('title','動画タイトル') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description','動画説明文（概要欄）') !!}
            {!! Form::text('description',null,['class'=>'form-control']) !!}
        </div>
    <button type="submit" class="btn btn-primary btn-lg d-block ml-3">投稿する？</button>
</form>

    <h2>{{ $user->name }} の投稿動画</h2>

@include('movies.movies_all', ['user'=>$user,'movies' => $movies])

@endsection