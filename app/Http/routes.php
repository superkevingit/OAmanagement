<?php

/*
 * OAsystem Web no need auth
 */
Route::group(['prefix'=>'auth'], function (){
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
});


/*
 * OAsystem Web need auth
 */
Route::group(['middleware'=>'auth'], function (){
    //Oauth
    Route::group(['prefix'=>'oauth'], function (){
        Route::get('oauth_client/code', 'OauthController@getCode');
        Route::get('oauth_client/user', 'OauthController@getByUser');
        Route::get('oauth_client/create', 'OauthController@create');
        Route::post('oauth_client', 'OauthController@store');
        Route::post('access_token', 'OauthController@postAccessToken');
        Route::group(['middleware'=>'checkAdmin'], function (){
            Route::resource('oauth_client', 'OauthController', ['only'=>[
                'index','destroy','update',
            ]]);
        });
        Route::group(['middleware'=>['check-authorization-params']], function (){
            Route::post('authorize', ['as' => 'oauth.authorize.post', function() {
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
        });
    });

    //user
    Route::group(['prefix'=>'user'], function (){
        Route::get('info', 'UserController@info');
    });

});


/*
 * OASystem API
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace'=>'App\Api\Controllers', 'prefix'=>'v1'], function ($api){
        $api->post('user/register', 'AuthController@register');
        $api->post('user/login', 'AuthController@authenticate');
        $api->post('oauth/access_token', function() {
            return Response::json(Authorizer::issueAccessToken());
        });

        $api->group(['middleware'=>['jwt.auth', 'oauth']], function ($api){
            $api->get('user/me', 'AuthController@getAuthenticatedUser');
            $api->get('organization_tags', 'OrganizationTagsController@index');
            $api->get('organization_tags/{id}', 'OrganizationTagsController@show');
        });
    });
});
