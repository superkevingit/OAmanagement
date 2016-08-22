<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $table = 'oauth_clients';
    protected $fillable = ['id', 'secret', 'name'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_oauth_client');
    }

    public function endpoints()
    {
        return $this->hasOne('App\OauthClientEndpoint', 'client_id');
    }
}
