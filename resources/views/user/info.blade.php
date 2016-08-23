@extends('app')
@section('title')
    - {{ $user->name }}
    @endsection
@include('nav')

@section('content')
    <div class="container">
    <h1>{{ $user->name }}</h1><br>
    <ul class="list-unstyled">
        <li>手机号: {{ $user->phone }}</li><br>
        <li>注册时间: {{$user->created_at}}</li><br>
        <li>学号： {{ $user->student_id or '暂无' }}</li><br>
        <li>认证状态：
            @if(!$user->confirmed)
                <span class="label label-danger">暂未认证</span>
                @else
                <span class="label label-success">已认证</span>
                @endif
        </li><br>
    </ul>
    </div>
@endsection