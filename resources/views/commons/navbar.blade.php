<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>
                <li>{!! link_to_route('signup.get','新規ユーザ登録',[],['class'=>'nav-link']) !!}</li>
                <li class="nav-item"><a href="#" class="nav-link">オススメ動画登録する</a></li>
            </ul>
        </div>
    </nav>
</header>