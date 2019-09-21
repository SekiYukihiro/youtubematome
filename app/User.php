<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'channel_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function feed_followings_movies()
    {
        $followings_user_ids = $this->followings()->pluck('users.id')->toArray();
        return Movie::whereIn('user_id',$followings_user_ids);
    }

    public function feed_followers_movies()
    {
        $followers_user_ids = $this->followers()->pluck('users.id')->toArray();
        return Movie::whereIn('user_id',$followers_user_ids);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class,'user_follow','user_id','follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'user_follow','follow_id','user_id')->withTimestamps();
    }

    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if($exist || $its_me){
            return false;
        }else{
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }


    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function users_access_tokens()
    {
        return $this->hasMany(UserAccessToken::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }

    public function passive_favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }

    public function favorite($movieId)
    {
        $exist = $this->is_favorite($movieId);

        if($exist){
            return false;
        }else{
            $this->favorites()->attach($movieId);
            return true;
        }
    }

    public function unfavorite($movieId)
    {
        $exist = $this->is_favorite($movieId);

        if($exist){
            $this->favorites()->detach($movieId);
            return true;
        }else{
            return false;
        }
    }

    public function is_favorite($movieId)
    {
        return $this->favorites()->where('movie_id',$movieId)->exists();
    }

    public function feed_favorites()
    {
        $favorite_movie_ids = $this->favorites()->pluck('movies.id')->toArray();
        return Movie::whereIn('id',$favorite_movie_ids);
    }

    public function feed_passive_favorites()
    {
        $favorite_movie_ids = $this->favorites()->pluck('movies.id')->toArray();
        return Movie::whereIn('id',$favorite_movie_ids);
    }

}
