<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $table = 'oauth_clients';
    protected $fillable = ['id', 'secret', 'name'];
    public $app_name;

    public function apply($app_name)
    {
        $oauth_client = self::create([
            'id'     => str_random(38),
            'secret' => str_random(38),
            'name'   => $app_name,
        ]);

        return $oauth_client->secret;
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_oauth_client')/*->withTimestamps()*/->withPivot('confirmed');
    }

    public function endpoints()
    {
        return $this->hasOne('App\OauthClientEndpoint', 'client_id');
    }
}
