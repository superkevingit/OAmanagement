<?php

namespace App\Http\Controllers;

use App\OauthClient;
use App\OauthClientEndpoint;
use App\User;
use DB;
use Illuminate\Http\Request;

class OauthController extends Controller
{
    public function getCode(Request $request)
    {
        $code = $request->get('code');

        return view('oauth/code', compact('code'));
    }

    public function update($oauth_client)
    {
        $client = DB::table('user_oauth_client')->where('oauth_client_id', '=', $oauth_client);
        $client->update(['confirmed' => 1]);

        return redirect(url('oauth/oauth_client'));
    }

    public function destroy($oauth_client)
    {
        OauthClient::find($oauth_client)->delete();

        return redirect(url('oauth/oauth_client'));
    }

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
        $OauthCount = (int) DB::table('oauth_clients')->count();
        $oauth_clients = OauthClient::with('users')->with('endpoints')->take($OauthCount)->orderBy('created_at', 'desc')->get()->toArray();

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
}
