<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * OAUTH2
 */
Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params', /*'auth'*/], function() {
    $authParams = Authorizer::getAuthCodeRequestParams();
    $formParams = array_except($authParams,'client');
    $formParams['client_id'] = $authParams['client']->getId();
    $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
        return $scope->getId();
    }, $authParams['scopes']));
    return view('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
}]);

Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => [/*'csrf',*/ 'check-authorization-params', /*'auth'*/], function() {
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
}]);

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});



/*
 * OASystem API
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace'=>'App\Api\Controllers', 'prefix'=>'v1'], function ($api){
        $api->post('user/register', 'AuthController@register');
        $api->post('user/login', 'AuthController@authenticate');

        $api->group(['middleware'=>['jwt.auth', 'oauth']], function ($api){
            $api->get('user/me', 'AuthController@getAuthenticatedUser');
            $api->get('organization_tags', 'OrganizationTagsController@index');
            $api->get('organization_tags/{id}', 'OrganizationTagsController@show');
        });
    });
});
