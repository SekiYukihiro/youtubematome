@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            @if($user == Auth::user())
            @else
            <li class="media">
                <a href="{{ route('users.show',['id'=>$user->id]) }}"><img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt=""></a>
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}

                        <div id="sample"></div>

                        <!--@include('movies.movies', ['user'=>$user,'movies' => $movies])-->
                        <div>

                        </div>
                    </div>
                    @if(Auth::check())
                        @include('user_follow.follow_button',['user'=>$user])
                    @endif
                </div>
            </li>
            @endif
        @endforeach
    </ul>
    {{ $users->render('pagination::bootstrap-4') }}
@endif

<script type="text/javascript">
// IFrame Player API の読み込み
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);

// YouTubeの埋め込み
function onYouTubeIframeAPIReady(){
        ytPlayer = new YT.Player(
                'sample', // 埋め込む場所の指定
                {
                        width:640, //プレーヤーの幅
                        height:390, //プレーヤーの高さ
                        videoId: 'Hga4nk-OJBg' //YouTubeのID
                }
                )
}
</script>