@extends('app')
@section('title', 'Oauth')
@include('nav')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="table">
                <table class="table table-hover">
                    <thead>
                    <colgroup>
                        <th>应用名称</th>
                        <th>详细信息</th>
                        <th>申请时间</th>
                        <th>申请人</th>
                        <th>状态</th>
                        <th>是否通过</th>
                        <th>删除</th>
                    </colgroup>
                    </thead>
                    <tbody>
                    @if($oauth_clients)
                        @foreach($oauth_clients as $oauth_client)
                            <tr>
                                <td>{{ $oauth_client['name'] }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">* * * * * * <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li>应用ID:{{ $oauth_client['id'] }}<</li>
                                            <li role="separator" class="divider"></li>
                                            <li>应用SECRET:{{ $oauth_client['secret'] }}<</li>
                                            <li role="separator" class="divider"></li>
                                            <li>应用回调地址:{{ $oauth_client['endpoints']['redirect_uri'] }}<</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $oauth_client['created_at'] }}</td>
                                @foreach($oauth_client['users'] as $user)
                                    <td>{{ $user['name'] }}</td>
                                    @if(!$user['pivot']['confirmed'])
                                        <td><span class="label label-danger">未审核</span></td>
                                        <td>
                                                <form method="POST" action="{{ secure_url('oauth/oauth_client',['oauth_client'=>$oauth_client['id']]) }}" accept-charset="UTF-8">
                                                    <input name="_method" type="hidden" value="PATCH" />
                                                    {!! csrf_field() !!}
                                                    <input type="submit" class="btn btn-primary" value="通过"/>
                                                </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ secure_url('oauth/oauth_client',['oauth_client'=>$oauth_client['id']]) }}" accept-charset="UTF-8">
                                                <input name="_method" type="hidden" value="DELETE" />
                                                {!! csrf_field() !!}
                                                <input type="submit" class="btn btn-primary" value="删除"/>
                                            </form>
                                        </td>
                                    @else
                                        <td><span class="label label-success">已审核</span></td>
                                        <td>
                                            <form method="POST" action="{{ secure_url('oauth/oauth_client',['oauth_client'=>$oauth_client['id']]) }}" accept-charset="UTF-8">
                                                <input name="_method" type="hidden" value="PATCH" />
                                                {!! csrf_field() !!}
                                                <input type="submit" class="btn btn-primary" disabled="disabled" value="通过"/>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ secure_url('oauth/oauth_client',['oauth_client'=>$oauth_client['id']]) }}" accept-charset="UTF-8">
                                                <input name="_method" type="hidden" value="DELETE" />
                                                {!! csrf_field() !!}
                                                <input type="submit" class="btn btn-primary" value="删除"/>
                                            </form>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
    </div>
    </div>
    </div>
@endsection