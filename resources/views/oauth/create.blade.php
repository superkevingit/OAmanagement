@extends('app')
@section('title', 'Oauth')
@include('nav')

@section('content')
    <div class="contanier">
        <div class="col-md-9" role="main">
            <h1 align="center">注册应用</h1>
            <form method="POST" action="{{ url('oauth/oauth_client') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">应用名称</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                        <button type="submit" class="btn btn-default">确认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection