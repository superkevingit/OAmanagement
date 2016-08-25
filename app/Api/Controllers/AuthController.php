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
use Illuminate\Support\Facades\Redis;
use App\Events\ConfirmUser;


class AuthController extends BaseController
{
    public function smsCheck(Request $ver)
    {
        $key = 'smsconfirm:'.\Auth::user()->phone;
        $value = Redis::get($key);
        $ver = $ver->get('ver');
        if (!$value)
        {
            return response()->json(['success'=>false, 'message'=>'verify code expired'], 403);
        }
        if ($value!=$ver)
        {
            return response()->json(['success'=>false, 'message'=>'verify code not right'], 403);
        }
        if(event(new ConfirmUser()))
        {
            return response()->json(['success'=>true, 'message'=>'confirm success']);
        }
        return response()->json(['success'=>false, 'message'=>'database update error'], 408);
    }

    public function smsConfirm()
    {
        if (\Auth::user()->confirmed)
        {
            return response()->json(['success'=>false, 'message'=>'account has confirmed'], 403);
        }
        $to = \Auth::user()->phone;
        $templates = [
            'Alidayu' => env('ALIDAYU_VERIFY_TEMPLATE_ID'),
        ];
        $tempData = [
            'ver' => rand(10000, 99999),
        ];
//        $back = PhpSms::make()->to($to)->template($templates)->data($tempData)->send();
        $back['success'] = true;
        if ($back['success'])
        {
            Redis::set('smsconfirm:'.$to, $tempData['ver']);
            Redis::expire('smsconfirm:'.$to, 300);
        }
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