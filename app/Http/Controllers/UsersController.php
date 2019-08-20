<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Movie;

use Google_Client;
use Google_Service_YouTube;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(10);

        return view('welcome',[
               'users'=>$users,
        ]);
    }

     public function privacy()
    {
        return view('auth.privacy_policy');
    }

    public function show($id)
    {
        $user = User::find($id);
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(10);


        $favorite_word = $user->favorite_word;


        require_once (dirname(__FILE__) . '/autoload.php');

        define("API_KEY","AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw");

        $client = new Google_Client();
        $client->setApplicationName("YouTubeMatome");
        $client->setDeveloperKey(API_KEY);

        $youtube = new Google_Service_YouTube($client);

        $params['q'] = $favorite_word;
        $params['type'] = 'video';
        $params['maxResults'] = 3;


        $favorite_word = htmlspecialchars($favorite_word);
        $videos = [];
        try {
            $searchResponse = $youtube->search->listSearch('snippet', $params);
            array_map(function ($searchResult) use (&$videos) {
                $videos[] = $searchResult;
            },$searchResponse['items']);
            } catch (Google_Service_Exception $e) {
            echo htmlspecialchars($e->getMessage());
            exit;
            } catch (Google_Exception $e) {
                echo htmlspecialchars($e->getMessage());
            exit;
            }


        $data=[
            'user'=>$user,
            'movies' => $movies,
            'favorite_word' => $favorite_word,
            'videos' => $videos,
        ];

        $data += $this->counts($user);

        return view('users.show',$data
        );
    }

    public function followings($id)
    {
        $user = User::find($id);
        // $movies = Movie::orderBy('created_at', 'desc')->paginate(1);
        $movies = $user->feed_followings_movies()->orderBy('created_at', 'desc')->paginate(10);

        $followings = $user->followings()->paginate(10);

        $data=[
            'movies' => $movies,
            'user'=>$user,
            'users'=>$followings,
        ];

        $data += $this->counts($user);

        return view('users.followings',$data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        // $movies = Movie::orderBy('created_at', 'desc')->paginate(1);
        $movies = $user->feed_followers_movies()->orderBy('created_at', 'desc')->paginate(10);

        $followers = $user->followers()->paginate(10);

        $data=[
            'movies' => $movies,
            'user'=>$user,
            'users'=>$followers,
        ];

        $data += $this->counts($user);

        return view('users.followers',$data);
    }

    public function channel($id)
    {
        $user=\Auth::user();
        $num="";

        return view('setting.channel',[
               'user'=>$user,
               'num'=>$num,
        ]);
    }

    public function wordStore(Request $request)
    {
        $this->validate($request,[
                'favorite_word' => 'required|max:191',
        ]);

        $user=\Auth::user();
        $user->favorite_word = $request->favorite_word;
        $user->save();

         return view('setting.channel',[
               'user'=>$user,
        ]);
    }


    public function rename(Request $request)
    {
        $user=\Auth::user();

        $user->channel_name = $request->channel_name;
        $user->name = $request->name;
        $user->save();

        return view('setting.channel',[
               'user'=>$user,
        ]);
    }

    public function profile(Request $request)
    {
        $user=\Auth::user();

        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return view('setting.channel',[
               'user'=>$user,
        ]);
    }

    public function deleteData()
    {
        $user = \Auth::user();

        $user->delete();

        Movie::where('user_id',$user->id)->delete();

        $users = User::orderBy('id','desc')->paginate(10);
        $movies = Movie::orderBy('created_at', 'desc')->paginate(10);

        $data = [
                'movies' => $movies,
                'users'=>$users,
        ];

        return view('welcome', $data);
    }

}
