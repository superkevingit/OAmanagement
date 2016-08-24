<?php
/**
 * Created by PhpStorm.
 * User: zaxk
 * Date: 2016/8/20
 * Time: 14:06
 */

namespace App\Api\Controllers;
use App\Api\Transformers\UsersTransformer;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use PhpSms;


class AuthController extends BaseController
{
    public function smsConfirm()
    {
        $to = \Auth::user()->phone;
        $templates = [
            'Alidayu' => env('ALIDAYU_VERIFY_TEMPLATE_ID'),
        ];
        $tempData = [
            'ver' => rand(10000, 99999),
        ];
        $back = PhpSms::make()->to($to)->template($templates)->data($tempData)->send();
        return $back;
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
       $newUser = [
           'phone' => $request->get('User_phone'),
           'name' => 'user_'.str_random(6),
           'password' => bcrypt($request->get('User_password')),
       ];
        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return $this->item($user, new UsersTransformer());
    }
}