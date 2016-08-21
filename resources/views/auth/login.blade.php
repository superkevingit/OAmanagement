@extends('app')
@section('title', '用户登录')
@include('nav')
@section('content')
    <div class="container">
    <div class="col-md-9" role="main">
        <h1 align="center">登陆</h1>
    <form method="POST" action="/auth/login" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">手机号</label>
            <div class="col-sm-10">
            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
            <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> 记住我
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登陆</button>
            </div>
        </div>
    </form>
    </div>
    </div>
@endsection