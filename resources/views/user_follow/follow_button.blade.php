@if (Auth::id() != $user->id)

    @if (Auth::user()->is_following($user->id))

        {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('このチャンネルのフォローを外す', ['class' => "button btn btn-danger mt-1"]) !!}
        {!! Form::close() !!}

    @else

        {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
            {!! Form::submit('このチャンネルをフォロー', ['class' => "button btn btn-primary mt-1"]) !!}
        {!! Form::close() !!}

    @endif

@endif