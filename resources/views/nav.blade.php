<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">OAmanagement User</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('user/info') }}">用户信息<span class="sr-only">(current)</span></a></li>
                <li><a href="#">{{ url() }}</li>
            @if (Auth::user())
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oauth2<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('oauth/oauth_client/create') }}">注册应用</a></li>
                    <li><a href="{{ url('oauth/oauth_client/user') }}">我的应用</a></li>
                    @if (Auth::user()->is_admin)
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">管理员权限</li>
                        <li><a href="{{ url('oauth/oauth_client') }}">全部应用</a></li>
                    @endif
                </ul>
            </li>
                @endif
            </ul>
            @if(Auth::user())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('auth/logout') }}">登出</a></li>
            </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('user/info') }}">{{ Auth::user()->name }}</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('auth/login') }}">登陆</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('auth/register') }}">注册</a></li>
                </ul>
            @endif

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>