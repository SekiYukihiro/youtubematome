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
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(9);


        $favorite_word = $user->favorite_word;

        $api = "AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw";
        $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=&key=$api&part=snippet,contentDetails,statistics,status";
        $json = @file_get_contents($get_api_url);

        if($json){

                require_once (dirname(__FILE__) . '/../../../vendor/autoload.php');

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

        }else{
                $videos = "";
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
        $movies = $user->feed_followings_movies()->orderBy('created_at', 'desc')->paginate(9);

        $followings = $user->followings()->paginate(9);

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
        $movies = $user->feed_followers_movies()->orderBy('created_at', 'desc')->paginate(9);

        $followers = $user->followers()->paginate(9);

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
                'favorite_word' => 'required|max:20',
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
        $this->validate($request,[
                'channel_name' => 'required|max:15',
                'name' => 'required|max:15',
        ]);

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
        $this->validate($request,[
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

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

        $users = User::orderBy('id','desc')->paginate(9);
        $movies = Movie::orderBy('created_at', 'desc')->paginate(9);

        $data = [
                'movies' => $movies,
                'users'=>$users,
        ];

        return view('welcome', $data);
    }

}
