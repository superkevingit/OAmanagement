@extends('app')
@section('title', 'Oauth')
@include('nav')

@section('content')
    <style>
        html,body{
            width:100%;
            height:100%;
            position:relative;
        }
        table{
            width:90%;
            height:auto;
        }
    </style>
    {{--<div class="container-fluid">--}}
    {{--<div class="row">--}}
        {{--<div class="table-responsive">--}}
    <table class="table table-hover " >
        <thead>
        <tr>
            <th class="col-md-1">应用名称</th>
            <th class="col-md-2">应用Id</th>
            <th class="col-sm-2">应用Secret</th>
            <th class="col-md-2">回调地址</th>
            <th class="col-md-2">申请时间</th>
            <th class="col-md-1">申请人</th>
            <th class="col-md-1">状态</th>
            <th class="col-md-1">是否通过</th>
            <th class="col-md-1">删除</th>
        </tr>
        </thead>
        <tbody>
        @if($oauth_clients)
            @foreach($oauth_clients as $oauth_client)
                    <tr>
                        <td>{{ $oauth_client['name'] }}</td>
                        <td>{{ $oauth_client['id'] }}</td>
                        <td>{{ $oauth_client['secret'] }}</td>
                        <td>{{ $oauth_client['endpoints']['redirect_uri'] }}</td>
                        <td>{{ $oauth_client['created_at'] }}</td>
                        @foreach($oauth_client['users'] as $user)
                            <td>{{ $user['name'] }}</td>
                            @if(!$user['pivot']['confirmed'])
                                <td><span class="label label-danger">未审核</span></td>
                                <td><a href="{{ url('oauth/oauth_client/') }}" class="btn btn-primary">通过</a></td>
                                <td><a href="{{ url('oauth/oauth_client/') }}" class="btn btn-primary">删除</a></td>
                            @else
                                <td><span class="label label-success">已审核</span></td>
                                <td><a href="{{ url('oauth/oauth_client/') }}" class="btn btn-primary" disabled="disabled">通过</a></td>
                                <td><a href="{{ url('oauth/oauth_client/') }}" class="btn btn-primary">删除</a></td>
                            @endif
                        @endforeach
                    </tr>
            @endforeach
        @endif
        </tbody>
    </table>
        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection