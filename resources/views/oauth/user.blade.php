@extends('app')
@section('title', 'Oauth')
@include('nav')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>应用名称</th>
            <th>应用Id</th>
            <th>应用Secret</th>
        </tr>
        </thead>
        <tbody>
        @if($oauth_apply)
            @foreach($oauth_apply as $oauth)
                @if( $oauth->pivot->confirmed)
                    <tr>
                        <td>{{ $oauth->name }}</td>
                        <td>{{ $oauth->id }}</td>
                        <td>{{ $oauth->secret }}</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ $oauth->name }}</td>
                        <td><span class="label label-danger">未审核</span></td>
                        <td><span class="label label-danger">***</span></td>
                    </tr>
                @endif
            @endforeach
        @endif
        </tbody>
    </table>
    @endsection