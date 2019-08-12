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
    public function index()
    {
        return view('upload');
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
        $upload_movie = Youtube::upload($request->file('video')->getPathName(),[
            'title' => 'My Video',
            'description' => 'This video is uploaded through API.',
            'tags' => ['api','youtube'],
        ]);

        $user = \Auth::user();
        $movie = new Movie;
        $movie->user_id = \Auth::user()->id;
        $movie->url = $upload_movie->videoId;

        $movie->save();


        $users = User::orderBy('id','desc')->paginate(10);
        $movies = Movie::orderBy('id','desc')->paginate(10);

        return view('welcome',[
               'users'=>$users,
               'movies'=>$movies,
        ]);

        // return $upload_movie->getVideoId();
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
