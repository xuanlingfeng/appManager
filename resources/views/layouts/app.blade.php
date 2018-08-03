<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="http://www.chinayzyx.cn/images/yzyx.ico">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: "Microsoft YaHei", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #666;
            background-color: #fff;
            overflow: hidden;
        }

        a{
            text-decoration：none;
        }

        #login-bgImg {
            position: absolute;
            z-index: -1;
        }
        
        #login-bgImg {
            position: absolute;
            z-index: -1;
        }
        .login-background-img > img {
            width: 100%;
            height: 100%;
        }

        .login_footer {
            position: absolute;
            bottom: 0px;
            left: 0px;
            width: 100%;
            font-size: 12px;
            color: #fff;
            line-height: 24px;
            padding-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-background-img">
        <img src="http://www.chinayzyx.com/images/admin/login_bg02.jpg" id="login-bgImg">
    </div>
    {{-- <div id="app">
       <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}

            <!-- Branding Image -->
            {{-- <a class="navbar-brand" href="{{ url('/') }}" sty>
                后台登录页面
            </a>
        </div> --}}

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="https://fsdhubcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/60/h/60" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

        @yield('content')
</div>
<div class="login_footer">
            <p>Copyright © 2012-2018 艺朝艺夕教育科技集团有限公司 版权所有</p>
</div>

