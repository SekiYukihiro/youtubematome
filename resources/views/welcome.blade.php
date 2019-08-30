@extends('layouts.app')

@section('content')


    <div class="center jumbotron bg-dark">

        <img id="change" class="rounded img-fluid" src="{{ $path }}" style="width:1046px; height:200px; object-fit:cover; object-position:0% 33%;">
        {{-- <img id="change" class="rounded img-fluid" src="storage/welcome_images/youtube.jpg" style="width:1046px; height:200px; object-fit:cover; object-position:0% 33%;"> --}}

        <div class="text-center text-white mt-5 pt-1">

            <h1 class="matome">YouTubeまとめ ×</h1>
            <h1 class="matome">コミュニケーション</h1>

        </div>

    </div>


    @if(Auth::check())

        <div class="text-right">

            @if(Auth::user()->icon_image_url)
                <span width="80px" height="80px">
                    <img class="rounded" src="{{ Storage::disk('s3')->url(Auth::user()->icon_image_url) }}" width="80px" height="80px">
                </span>
            @else
                <a href="{{ route('users.show',['id'=>Auth::id()]) }}"><img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 80) }}" alt=""></a>
            @endif

            {{ Auth::user()->name }}

        </div>

    @else

        <h5 class="description text-right">みんなが "オススメしたい" YouTube動画を 自由にシェアできる</h5>
        <h5 class="description2 text-right">< 動画コミュニケーションサービス ></h5>

    @endif


        @include('movies.movies', ['users'=>$users])


@endsection