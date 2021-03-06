<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{

    use SoftDeletes;

    protected $table = 'movies';
    protected $dates = ['deleted_at'];

    protected $fillable = ['title','user_id','upload_id','url'];

    public function user()
    {
            return $this->belongsTo(User::class);
    }

    public function favorite_users()
    {
            return $this->belongsToMany(User::class,'favorites','movie_id','user_id')->withTimestamps();
    }
}
