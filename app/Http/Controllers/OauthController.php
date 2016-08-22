<?php

namespace App\Http\Controllers;

use App\OauthClient;
use App\OauthClientEndpoint;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OauthController extends Controller
{
    public function create()
    {
       return view('oauth.create');
    }

    public function store(Request $request)
    {
        $client['id'] = str_random(38);
        $client['secret'] = str_random(38);
        $client['name'] = $request->get('name');
        $oauth_client = new OauthClient($client);
        $oauth_client->save();
        $secret = $oauth_client->secret;
        $oauth_client = OauthClient::where('secret', $secret)->first();
        $oauth_client->endpoints()->save(new OauthClientEndpoint([
            'redirect_uri' => url('oauth/oauth_client').'/'.\Auth::user()->id.'/code',
        ]));
        $oauth_client->users()->save(\Auth::user());
        return $oauth_client;
    }

    public function getAuthorize()
    {
        $authParams = Authorizer::getAuthCodeRequestParams();
        $formParams = array_except($authParams,'client');
        $formParams['client_id'] = $authParams['client']->getId();
        $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
            return $scope->getId();
        }, $authParams['scopes']));
        return view('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
    }

    public function postAuthorize()
    {
        $params = Authorizer::getAuthCodeRequestParams();
        $params['user_id'] = Auth::user()->id;
        $redirectUri = '/';
        if (Request::has('approve')) {
            $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
        }
        if (Request::has('deny')) {
            $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
        }
        return Redirect::to($redirectUri);
    }

    public function postAccessToken()
    {
        return Response::json(Authorizer::issueAccessToken());
    }
}
