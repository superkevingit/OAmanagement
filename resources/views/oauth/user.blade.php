@extends('app')
@section('title', 'Oauth')
@include('nav')

@section('content')
    <div class="container">
        <h1>应用</h1>
        <hr>

        @if($oauth_apply)
            <div class="row">
            @foreach($oauth_apply as $oauth)
            @if( $oauth->pivot->confirmed)
                <div class="col-lg-4">
                    <h2>{{ $oauth->name }}</h2>
                    <p>应用id: <br>{{ $oauth->id }}</p>
                    <p>应用secret: <br>{{ $oauth->secret }}</p>
                    <p>应用回调地址: <br>{{ $oauth->endpoints->redirect_uri }}</p>
                    <p>
                    <?php $params = [
                        'redirect_uri' => $oauth->endpoints->redirect_uri,
                        'response_type' => 'code',
                        'client_id' => $oauth->id,
                    ] ?>
                    <form method="post" action="{{ route('oauth.authorize.post', $params) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="client_id" value="{{ $oauth->id }}">
                        <input type="hidden" name="redirect_uri" value="{{ $oauth->endpoints->redirect_uri }}">
                        <input type="hidden" name="response_type" value="code">
                        {{--<input type="hidden" name="state" value="">--}}
                        {{--<input type="hidden" name="scope" value="">--}}
                        <input type="hidden" name="approve" value="1">
                        <input type="submit" class="btn btn-primary" value="获取Code">
                    </form>
                    </p>
                </div>
            @else
                <div class="col-lg-4">
                    <h2>{{ $oauth->name }}</h2>
                    <p>应用id: <br><span class="label label-danger">未审核</span></p>
                    <p>应用secret: <br><br><span class="label label-danger">未审核</span></p>
                    <p>应用回调地址: <br><br><span class="label label-danger">未审核</span></p>
                    <p><a class="btn btn-primary" href="#" role="button" disabled="disabled">获取Code »</a></p>
                </div>
            @endif
            @endforeach
            </div>
        @endif
    </div>

    @endsection