@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
            <div class="text-center">
                <h1>YouTubeまとめ×コミュニケーション</h1>
            </div>
        </div>
    @if(Auth::check())
        {{ Auth::user()->name }}
    @else
    @endif
        @include('users.users',['users'=>$users])
@endsection