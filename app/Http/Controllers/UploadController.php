<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\User;

use Youtube;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pre()
    {
        return view('pre_upload');
    }

    public function auth()
    {
        // return Socialite::driver($provider)->redirect();
        return redirect ('/youtube/auth');
    }

    public function authGoogleCallback()
    {
        // $googleUser = Socialite::driver('google')->user();

        return view('upload');
        // return redirect()->route('upload');
    }

    public function index()
    {
        $user=\Auth::user();
        $movies = $user->movies()->where('upload_id',1)->orderBy('created_at', 'desc')->paginate(10);

        return view('upload',['user'=>$user,'movies'=>$movies,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                    'video' => 'required|file|mimes:mp4,qt,x-ms-wmv,mpeg,x-msvideo',
                    'title' => 'required|max:24',
                    'description' => 'required|max:191',
        ]);

        $upload_movie = Youtube::upload($request->file('video')->getPathName(),[
            'title' => $request->title,
            'description' => $request->description,
            // 'tags' => ['api','youtube'],
        ]);

        $user = \Auth::user();
        $movie = new Movie;
        $movie->user_id = \Auth::user()->id;
        $movie->url = $upload_movie->getVideoId();
        // $movie->url = $upload_movie->videoId;
        $movie->upload_id = "1";

        $movie->save();

        $movies = $user->movies()->where('upload_id',1)->orderBy('created_at', 'desc')->paginate(10);

        return view('upload',['user'=>$user,'movies'=>$movies,]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
