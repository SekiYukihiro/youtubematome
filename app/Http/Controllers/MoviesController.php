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

        // $movies = User::feed_movies()->orderBy('created_at', 'desc')->paginate(1);
        $movies = Movie::orderBy('created_at', 'desc')->paginate(10);

        $users = User::orderBy('id','desc')->paginate(10);

        $data = [
                'movies' => $movies,
                'users'=>$users,
        ];

        return view('welcome', $data);
    }

    public function store(Request $request)
    {

            $this->validate($request,[
                    'url' => 'required|max:191',
            ]);

            $request->user()->movies()->create([
                    'url' => $request->url,
            ]);

            return back();
    }

    public function deleteData($m_id)
    {
        // $target_movie = Movie::find($request->id);

        // dd($request->id);
        // $target_movie->delete();

        // return back();
        $data = [];

        $user = \Auth::user();
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(10);

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
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(10);

        // $target_id = $request->input('m_id') ? $request->input('m_id') : null;

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
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(10);

        // $target_id = $request->input('m_id') ? $request->input('m_id') : null;

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
