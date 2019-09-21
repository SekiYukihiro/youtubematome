<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccessToken extends Model
{
    public $timestamps = false;

    protected $table = 'users_access_tokens';

    protected $fillable = ['user_id','access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
