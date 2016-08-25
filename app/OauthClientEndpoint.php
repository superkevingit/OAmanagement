<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClientEndpoint extends Model
{
    protected $table = 'oauth_client_endpoints';
    protected $fillable = ['id', 'client_id', 'redirect_uri'];
    public $oauth_client;

    public function apply(OauthClient $oauth_client)
    {
        $oauth_client->endpoints()->save(new self([
            'redirect_uri' => url('oauth/oauth_client').'/code',
        ]));
    }
}
