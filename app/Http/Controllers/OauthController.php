<?php

namespace App\Http\Controllers;

use App\OauthClient;
use App\OauthClientEndpoint;
use App\User;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OauthController extends Controller
{
    public function getByUser()
    {
        $oauth_apply = null;
        $user = \Auth::user();
        $oauth_apply = $user->oauth_clients->all();
        return view('oauth.user', compact('oauth_apply'));
    }

    public function index()
    {
        $oauth_clients = null;
        $OauthCount = (int)DB::table('oauth_clients')->count();
        $oauth_clients = OauthClient::with('users')->with('endpoints')->take($OauthCount)->get()->toArray();
//        dd($oauth_clients);
        return view('oauth.index', compact('oauth_clients'));
    }

    public function create()
    {
       return view('oauth.create');
    }

    public function store(Request $request)
    {
        $secret = (new OauthClient())->apply($request->get('name'));
        $oauth_client = OauthClient::where('secret', '=', $secret)->first();
        (new OauthClientEndpoint())->apply($oauth_client);
        (new User())->apply_oauth_client($oauth_client);

        return redirect(url('oauth/oauth_client/user'));
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
