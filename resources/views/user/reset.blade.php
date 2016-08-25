@extends('app')
@section('title', '用户登录')
@include('nav')
@section('content')
    <div class="container">
        <form method="POST" action="/password/reset">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div>
                手机号
                <input type="number" name="phone" value="{{ old('phone') }}">
            </div>

            <div>
                密码
                <input type="password" name="password">
            </div>

            <div>
                重新输入密码
                <input type="password" name="password_confirmation">
            </div>

            <div>
                <button type="submit">
                    重置密码
                </button>
            </div>
        </form>
    </div>
@endsection