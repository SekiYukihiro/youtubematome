@extends('layouts.app')

@section('content')

    <div class="text-center">

        <h1 class="matome">YouTubeまとめ ×</h1>
        <h1 class="matome">コミュニケーション</h1>

        <img id="change" class="rounded img-fluid" src="{{ Storage::disk('s3')->url('movie.jpg') }}" style="width:700px; height:100px; object-fit:cover; object-position:0% 60%;">

    </div>


    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5 mb-2">自分の動画をYouTube投稿する前に</h3>
    </div>

    <div class="text-center">
        <img id="change" class="rounded img-fluid" src="{{ Storage::disk('s3')->url('google.png') }}" style="width:700px;">
    </div>

    <div class="text-center">
        <h5 class="google text-left d-inline-block">↑ Google認証前に表示される画面</h5>
    </div>

    <div class="text-center mt-3 mb-3">
        <p class="google text-left d-inline-block">新規ユーザ登録して利用される場合、<span class="channel_follow">Googleアカウントの認証が必要となります。</span><br><br>認証の際「このアプリは確認されていません」と</span><span class="channel_follow">表示が出たら、左下の「詳細」から当アプリに<br></span>アクセス下さい。
            <br><br><span class="channel_follow">※現在Googleに当アプリの申請を提出し、</span><span class="channel_follow">　承認待ち中です。</span></p>
    </div>


    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">⬇︎つぎへ進む</h3>
    </div>

    <div class="row mt-5 mb-2">
        <div class="col-sm-6 offset-sm-3">

                <div class="register_button">
                    <a href="{{ route('upload')}}" class="button btn btn-primary mb-5">Google認証してアップロードへ</a>
                    {{--{!! link_to_route('auth','Google認証してアップロードへ',[],['class'=>'button btn btn-primary mb-5']) !!}--}}
                </div>

        </div>
    </div>

@endsection