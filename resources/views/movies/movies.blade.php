
<ul class="list-unstyled">
    @foreach ($movies as $movie)

            <li class="media mb-3">
                 @if($user->icon_image_url)
                    <img class="rounded img-fluid" src="{{ Storage::url($movie->user->image_url) }}" width="50px" height="50px">
                 @else
                    <img class="rounded img-fluid" src="{{ Gravatar::src($movie->user->email,50) }}" alt="">
                 @endif
                    <div class="media-body">
                        @if($movie->user->channel_name)
                        <div>
                            {!! link_to_route('users.show',$movie->user->channel_name,['id'=>$movie->user->id]) !!}
                        </div>
                        @else
                        @endif
                        <div>
                            {!! link_to_route('users.show',$movie->user->name,['id'=>$movie->user->id]) !!}
                        </div>
                        <div>
                            <div class="video-wrap">
                                <iframe width="200" height="112.5" src="{{ 'https://www.youtube.com/embed/'.$movie->url }}?controls=1&loop=1&playlist={{ $movie->url }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                            <p class="mb-0">{!! nl2br(e($movie->title)) !!}</p>
                        </div>
                        @if(Auth::check())
                            @include('user_follow.follow_button',['user'=>$movie->user])
                        @endif
                    </div>
            </li>

    @endforeach
</ul>
{{ $movies->render('pagination::bootstrap-4') }}