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
        <h1>{{ Auth::user()->channel_name }} のチャンネル設定</h1>

        <h2 class="mt-5">表示名</h2>

        {!! Form::model($user,['route'=>['rename',$user->id],'method'=>'put']) !!}

                <div class="form-group">
                        {!! Form::label('channel_name','チャンネル名') !!}
                        {!! Form::text('channel_name',old('channel_name'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('name','名前') !!}
                        {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}

        <h2 class="mt-5">お気に入りワードを設定</h2>

        <p>現在のお気に入りワード："{{ Auth::user()->favorite_word }}"</p>

        {!! Form::open(['route'=>'word.store']) !!}
                <div class="form-group">
                        {!! Form::label('favorite_word','お気に入りワードを入力') !!}
                        {!! Form::text('favorite_word',old('favorite_word'),['class'=>'form-control']) !!}
                </div>
                        {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}


        <figure class="mt-5">
                <img class="rounded img-fluid" src="{{ Storage::url(Auth::user()->icon_image_url) }}" width="100px" height="100px">
                <figcaption>現在のアイコン画像</figcaption>
        </figure>

        <form method="POST" action="/storeIcon" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="photo" class="btn btn-lg">
                <input type="submit" value="更新する？" class="btn btn-primary btn-lg d-block ml-3">
        </form>


        <h2 class="mt-5">トップ画像を編集</h2>

        {!! Form::model($user,['route'=>['topTrim'],'method'=>'post']) !!}
                <div class="form-group">
                        {!! Form::label('top_trim','切り取る位置（高さ）を入力　（例）０→写真の一番上を切り取る　100→写真の一番下を切り取る') !!}
                        {!! Form::text('top_trim',old('top_trim'),['class'=>'form-control','id'=>'top_trim']) !!}
                </div>
                        {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3','id'=>'top_trim_btn']) !!}
        {!! Form::close() !!}

        <figure class="mt-5">
                <img id="change" class="rounded img-fluid" src="{{ Storage::url(Auth::user()->top_image_url) }}" width="1000px" height="200px" style="width:100%; height:200px; object-fit:cover; object-position:0% {{ $user->top_trim }}%;">
                <figcaption>現在のチャンネルトップ画像</figcaption>




        <h3><i class="fa fa-crop"></i> cropperのデモ </h3>
<!-- 切り抜きボタン -->
<form method="POST" action="/topTrimming" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="submit" id="getData" value="Get Data？" class="btn btn-primary">
</form>
<br><br>
<div class="cropper-example-1">
  <!-- bladeテンプレートを使用していれば asset()や url() 関数が使えます -->
  <img id="img" class="img-responsive" src="{{ Storage::url(Auth::user()->top_image_url) }}" alt="">
</div>




        <figure class="mt-5">
                <img class="rounded img-fluid" src="{{ Storage::url(Auth::user()->top_image_url) }}" width="1000px" height="200px">
                <figcaption>現在のチャンネルトップ画像</figcaption>
        </figure>

        <form method="POST" action="/storeTop" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="photo" class="btn btn-lg">
                <input type="submit" value="更新する？" class="btn btn-primary btn-lg d-block ml-3">
        </form>


        <h2 class="mt-5">詳細プロフィール</h2>

        {!! Form::model($user,['route'=>['profile',$user->id],'method'=>'put']) !!}

                <div class="form-group">
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

                {!! Form::submit('更新する？',['class'=>'btn btn-primary btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}

        <h2 class="mt-5">チャンネル・ユーザ退会</h2>

        {!! Form::model($user,['route'=>['users.delete',$user->id],'method'=>'delete']) !!}
                {!! Form::submit('退会する？',['class'=>'btn btn-danger btn-lg d-block ml-3']) !!}
        {!! Form::close() !!}


<script type="text/javascript">

// init
// class='cropper-example-1のimgタグに適用'
var $image = $('.cropper-example-1 > img'),replaced;

//crop options
// id='imgに適用'
$('#img').cropper({
  aspectRatio: 16 / 9 // ここでアスペクト比の調整 ワイド画面にしたい場合は 16 / 9

  });

$('#getData').on('click', function(){

   // crop のデータを取得
   var data = $('#img').cropper('getData');

   // 切り抜きした画像のデータ
   // このデータを元にして画像の切り抜きが行われます
   var image = {
     width: Math.round(data.width),
     height: Math.round(data.height),
     x: Math.round(data.x),
     y: Math.round(data.y),
     _token: 'jf89ajtr234534829057835wjLA-SF_d8Z' // csrf用
    };
   // post 処理
   $.post('/topTrimming', image, function(res){
     // 成功すれば trueと表示されます
     console.log(res);
   });

});

</script>


@endsection