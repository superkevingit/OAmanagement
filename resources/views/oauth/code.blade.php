@extends('app')
@section('title', 'Oauth')
@include('nav')

@section('content')
    <div class="container">
        <h1 align="center">Code</h1>
        <hr>
        <h1 align="center">{{ $code }}</h1><br>
        <p class="bg-warning" align="center">请妥善保存</p>
        <p class="bg-warning" align="center">暂时无过期时间</p>
        <div class="container bg-success">
        <h3>使用Code获取access_token方法</h3>
            <h4> * 推荐使用postman</h4>
        <p>
        <h4>请求参数</h4>
        <ul>
            <li>client_id</li>
            <li>client_secret</li>
            <li>grant_type(default=authorization_code)</li>
            <li>redirect_uri</li>
            <li>code</li>
        </ul>
        <h4>请求方法</h4>
           <code>POST</code>
        <h4>请求url</h4>
            <code>example.com/api/v1/oauth/access_token</code>
        <h4>返回示例</h4>
            <code>
            {<br>
                "access_token": "K03SWd0xbmUJMGRRqNe6X862p50KNdIUvkB9FwH9",<br>
                "token_type": "Bearer",<br>
                "expires_in": 7776000 <br>
            }
            </code>
        </div>
    </div>
@endsection