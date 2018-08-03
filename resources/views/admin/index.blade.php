<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>安徽艺朝艺夕教育咨询有限公司线上课堂</title>
  <link rel="shortcut icon" href="http://www.chinayzyx.cn/images/yzyx.ico">
  <script src="{{ asset('js/jquery.js') }}"></script>
	<link rel="stylesheet" href="{{asset('layui/css/layui.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
	<style>
    .layui-logo img{
        display:inline-block;
        height:50px;
    }
	.layui-form-item .resource{
        width:200px;
        margin-top:5px;
        float:left;
    }
  .layui-textarea{
    width:100%;
    }
  .layui-input, .layui-select,.layui-textarea{
    border-width:1px;
    }
  .pagination {
    display: inline-block;
    vertical-align: middle;
    margin: 10px 0;
    font-size: 16px;
    }
  .pagination li a {
    display: inline-block;
    vertical-align: middle;
    padding: 0 15px;
    height: 28px;
    margin: 0 -1px 5px 0;
    background-color: #fff;
    }
  .pagination li {
    float: left;
    margin: 0 4px;
    }
  .box {
        width:32%;
        height:50px;
        margin-bottom:50px;
        float:left;
        text-align: left;
    }
</style>
</head>
<body class="layui-layout-body">
      <div class="layui-layout layui-layout-admin">
          <div class="layui-header">
            <div class="layui-logo"><img title="安徽艺朝艺夕教育集团" alt="安徽艺朝艺夕教育集团" src="{{asset('images/logo.png')}}"/></div>
            <!-- 头部区域-->
            <ul class="layui-nav layui-layout-left">
            </ul>
            <ul class="layui-nav layui-layout-right">
              <li class="layui-nav-item">
                <a href="javascript:;">
                  <img src="{{session('avatar')}}" class="layui-nav-img">
                </a>
                <dl class="layui-nav-child">
                  <dd><a href="{{url('admin/basicinformation')}}">基本资料</a></dd>
                  <!-- <dd><a href="javascript:;">安全设置</a></dd> -->
                </dl>
              </li>
              <li class="layui-nav-item">
                  <a href="{{Auth::logout() }}">
                      退出
                  </a>
                  <form id="logout-form" action="" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
            </ul>
          </div>
          <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
              <!-- 左侧导航区域 -->
              <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                @role('admin')
                <li class="layui-nav-item">
                  <a href="{{ url('/admin/user/') }}">用户管理</a>
                </li>
                @endrole
                @role('admin')
                <li class="layui-nav-item">
                    <a href="{{ url('/admin/permission/') }}">权限管理</a>
                </li>
                @endrole
              </ul>
            </div>
          </div>
          <div class="layui-body">
          <!-- 内容主体区域 -->
            @yield('content')
          </div>
          <div class="layui-footer">
          <!-- 底部固定区域 -->
          Copyright © 2012-2018 安徽艺朝艺夕教育咨询有限公司
          </div>
      </div>
  </div>
 <script src="{{asset('layui/layui.js')}}"></script>
 <script src="{{asset('layui/layui.all.js')}}"></script>
 <script src="{{asset('layui/lay/modules/laypage.js')}}"></script>
 <script src="{{asset('layui/lay/modules/laydate.js')}}"></script>
 <script src="{{asset('layui/lay/modules/jquery.js')}}"></script>
 @yield('js')       
</body>
</html>

