@extends('layouts.app')

@section('content')


        @if($user->channel_name)

                <div class="text-right">

                        @if($user->icon_image_url)
                                <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="80px" height="80px">
                        @else
                                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 80) }}" alt="">
                        @endif

                        {{ Auth::user()->name }}

                </div>

                <div class="user_name mt-3">

                        <h1 class="channel_name d-inline mt-3">{{ Auth::user()->channel_name }}</h2>
                        <h1 class="channel_name setting d-inline">チャンネル設定</h2>

                </div>

        @else

                <div>

                        @if($user->icon_image_url)
                                <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="80px" height="80px">
                        @else
                                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 80) }}" alt="">
                        @endif

                        <h1 class="channel_name d-inline mt-3">{{ Auth::user()->name }}</h2>
                        <h1 class="channel_name setting d-inline">チャンネル設定</h2>

                </div>

        @endif


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">表示名</h2>

                {!! Form::model($user,['route'=>['rename',$user->id],'method'=>'put']) !!}

                        <div class="form-group mt-5">
                                {!! Form::label('channel_name','チャンネル名') !!}
                                {!! Form::text('channel_name',old('channel_name'),['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                                {!! Form::label('name','名前') !!}
                                {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                        </div>

                        <div class="register_button">
                                {!! Form::submit('更新する？',['class'=>'button btn btn-primary mt-3 mb-5']) !!}
                        </div>

                {!! Form::close() !!}

        </section>


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">お気に入りワード設定</h2>

                <h4 class="text-center mt-5">お気に入りワード<span class="favorite_word_channel pl-3">"{{ Auth::user()->favorite_word }}"</span></h4>

                        {!! Form::open(['route'=>'word.store']) !!}

                        <div class="form-group">
                                {!! Form::label('favorite_word','お気に入りワードを入力') !!}
                                {!! Form::text('favorite_word',old('favorite_word'),['class'=>'form-control']) !!}
                        </div>

                        <div class="register_button">
                                {!! Form::submit('更新する？',['class'=>'button btn btn-primary mt-3 mb-5']) !!}
                        </div>

                        {!! Form::close() !!}

        </section>


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">アイコン画像を変更</h2>

                <figure class="mt-3">

                        <div class="ml-3 mt-5">
                                @if(Auth::user()->icon_image_url)
                                        <div width="100px" height="100px">
                                                <img class="rounded" src="{{ Storage::disk('s3')->url(Auth::user()->icon_image_url) }}" width="100px" height="100px">
                                        </div>
                                @else
                                        <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 100) }}" alt="">
                                @endif
                                <figcaption>現在のアイコン画像</figcaption>
                        </div>

                </figure>

                <form method="POST" action="/storeIcon" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="register_button">
                                <input type="file" name="photo" class="file_button btn">

                                <div>
                                        <input type="submit" value="更新する？" class="button btn btn-primary mt-3 mb-5">
                                </div>
                        </div>
                </form>

        </section>


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">トップ画像をアップ</h2>

                <figure class="mt-5">

                        @if(Auth::user()->top_image_url)
                                <img class="rounded img-fluid" src="{{ Storage::url(Auth::user()->top_image_url) }}">
                                <figcaption>現在のチャンネルトップ画像（編集前）</figcaption>
                        @else
                                <img class="rounded img-fluid" src="{{ secure_asset('/storage/welcome_images/youtube.jpg') }}">
                                <figcaption>※これはサンプル画像です お好きな画像を選択して下さい</figcaption>
                        @endif

                </figure>

                <form method="POST" action="/storeTop" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="register_button">
                                <input type="file" name="photo" class="file_button btn">

                                <div>
                                        <input type="submit" value="更新する？" class="button btn btn-primary mt-3 mb-5">
                                </div>
                        </div>
                </form>

        </section>


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">トップ画像を編集</h2>

                <figure class="mt-5">

                        @if(Auth::user()->top_image_url)
                                <img id="change" class="rounded img-fluid" src="{{ Storage::url(Auth::user()->top_image_url) }}" style="width:1200px; height:200px; object-fit:cover; object-position:0% {{ $user->top_trim }}%;">
                                <figcaption>現在のチャンネルトップ画像（編集済）</figcaption>
                        @else
                                <img id="change" class="rounded img-fluid" src="{{ secure_asset('/storage/welcome_images/youtube.jpg') }}" style="width:1200px; height:200px; object-fit:cover; object-position:0% {{ $user->top_trim }}%;">
                                <figcaption>※これはサンプル画像です お好きな画像を選択して下さい</figcaption>
                        @endif

                </figure>

                {!! Form::model($user,['route'=>['topTrim'],'method'=>'post']) !!}

                        <div class="form-group">

                                {!! Form::label('top_trim','切り取る位置（高さ）を 0 ~ 100 の数値で入力',['class'=>'text-success']) !!}
                                <div>例）画像の一番上を切り取る : "<span class="text-success">0</span>" を入力</div>
                                <div>　　画像の一番下を切り取る : "<span class="text-success">100</span>" を入力</div>
                                {!! Form::text('top_trim',old('top_trim'),['class'=>'form-control','id'=>'top_trim']) !!}

                        </div>

                        <div class="register_button">
                                {!! Form::submit('更新する？',['class'=>'button btn btn-primary mt-3 mb-5']) !!}
                        </div>

                {!! Form::close() !!}

        </section>


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">詳細プロフィール</h2>

                {!! Form::model($user,['route'=>['profile',$user->id],'method'=>'put']) !!}

                        <div class="form-group mt-5">
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

                        <div class="register_button">
                                {!! Form::submit('更新する？',['class'=>'button btn btn-primary mt-3 mb-5']) !!}
                        </div>

                {!! Form::close() !!}

        </section>


        <section class="clearfix">

                <div class="semicolon">”</div>
                <h2 class="mt-5">ユーザー退会</h2>

                {!! Form::model($user,['route'=>['users.delete',$user->id],'method'=>'delete']) !!}
                        <div class="register_button mt-3">
                                {!! Form::submit('退会する？',['class'=>'button btn btn-danger mt-3 mb-5']) !!}
                        </div>
                {!! Form::close() !!}

        </section>


@endsection