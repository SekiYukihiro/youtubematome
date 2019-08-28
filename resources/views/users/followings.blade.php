@extends('layouts.app')

@section('content')

            @include('users.user_top',['user'=>$user])

            @include('users.navtabs',['user'=>$user])

            @include('movies.movies', ['users'=>$users,'movies' => $movies])

@endsection