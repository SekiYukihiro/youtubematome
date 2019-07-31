@extends('layouts.app')

@section('content')
        <li class="media">
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                </div>
        </li>
        <h1>{{ $user->channel_name }}</h1>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="#" class="nav-link">動画</a></li>
                <li class="nav-item"><a href="#" class="nav-link">フォロワー</a></li>
                <li class="nav-item"><a href="#" class="nav-link">フォロー中</a></li>
            </ul>
        </div>
@endsection