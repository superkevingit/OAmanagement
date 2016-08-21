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
                <li class="active"><a href="#">用户信息<span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
            </ul>
            @if(Auth::user())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('auth/logout') }}">登出</a></li>
            </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">{{ Auth::user()->name }}</a></li>
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