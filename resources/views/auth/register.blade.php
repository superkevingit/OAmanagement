@extends('app')
@section('title', '用户注册')
@include('nav')
@section('content')
    <div class="contanier">
        <div class="col-md-9" role="main">
            <h1 align="center">注册</h1>
    <form method="POST" action="/auth/register">
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
            <label for="password" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
            <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-10">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>
    </form>
    </div>
    </div>
@endsection