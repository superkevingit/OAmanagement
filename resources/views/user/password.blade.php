@extends('app')
@section('title', '用户登录')
@include('nav')
@section('content')
    <div class="container">
    <form method="POST" action="/password/email">
    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit">
            发送重置密码邮件
        </button>
    </div>
</form>
</div>
@endsection