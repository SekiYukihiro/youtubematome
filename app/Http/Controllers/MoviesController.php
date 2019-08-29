<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;
use App\User;

class MoviesController extends Controller
{
    public function index()
    {
        $data = [];

        $users = User::orderBy('id','desc')->paginate(9);

        $data = [
                'users'=>$users,
        ];

        return view('welcome', $data);
    }

    public function disp()
    {
        $path = Storage::disk('s3')->url('youtube.jpg');
        return view('disp', compact('path'));
    }

    public function store(Request $request)
    {

            $this->validate($request,[
                    'url' => 'required|max:11',
            ]);

            $request->user()->movies()->create([
                    'url' => $request->url,
            ]);

            return back();
    }

    public function deleteData($m_id)
    {
        $data = [];

        $user = \Auth::user();
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(9);

        $target_movie = Movie::find($m_id);

        $target_movie->delete();

        $m_id = "";
        $target_id = $m_id;
        $target_title = "";
        $target_url = "";

        $user_id = $user->id;

        $data=[
            'user'=>$user,
            'movies' => $movies,
            'target_movie'=>$target_movie,
            'target_id'=>$target_id,
            'target_title'=>$target_title,
            'target_url'=>$target_url,
            'm_id'=>$m_id,
        ];

        return redirect('/recommend/$user_id');
    }

    public function recommend()
    {
        $data = [];

        $user = \Auth::user();
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(9);

        $target_movie = "";
        $target_id = "";
        $target_title = "";
        $target_url = "";

        $data=[
            'user'=>$user,
            'movies' => $movies,
            'target_movie'=>$target_movie,
            'target_id'=>$target_id,
            'target_title'=>$target_title,
            'target_url'=>$target_url,
        ];

        return view('setting.recommend',$data);
    }

    public function select(Request $request,$m_id)
    {
        $data = [];

        $user = \Auth::user();
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(9);

        $target_movie = Movie::find($m_id);
        $target_id = $m_id;
        $target_title = $target_movie->title;
        $target_url = $target_movie->url;

        $data=[
            'user'=>$user,
            'movies' => $movies,
            'target_movie'=>$target_movie,
            'target_id'=>$target_id,
            'target_title'=>$target_title,
            'target_url'=>$target_url,
        ];

        return view('setting.recommend',$data);
    }
}
