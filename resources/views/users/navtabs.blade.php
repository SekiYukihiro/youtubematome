<ul class="nav nav-tabs nav-justified mb-3">
        <li class="nav-item"><a href="{{ route('users.show',['id'=>$user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">動画<span class="badge badge-secondary">{{ $count_movies }}</span></a></li>
        <li class="nav-item"><a href="{{ route('users.followers',['id'=>$user->id]) }}" class="nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}">フォロワー<span class="badge badge-secondary">{{ $count_followers }}</span></a></li>
        <li class="nav-item"><a href="{{ route('users.followings',['id'=>$user->id]) }}" class="nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}">フォロー中<span class="badge badge-secondary">{{ $count_followings }}</span></a></li>
</ul>