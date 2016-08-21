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
 * Oauth2
 */
//Route::
Route::group(['middleware'=>'auth'], function (){
    Route::post('oauth/access_token', 'OauthController@postAccessToken');
    Route::get('user/info', 'UserController@info');
    Route::group(['middleware'=>'check-authorization-params'], function (){
        Route::get('oauth/authorize', 'OauthController@getAuthorize');
        Route::post('oauth/authorize', 'OauthController@postAuthorize');//may need csrf middleware!
   });
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

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
