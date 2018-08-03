@extends('layouts.app')

@section('content')
<div class="container" style="width:55%; margin-top:150px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-7">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>登录系统</h4></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('work_order') ? ' has-error' : '' }}">
                            <label for="work_order" class="col-md-4 control-label">用户名</label>

                            <div class="col-md-6">
                                <input id="work_order" type="name" class="form-control"  placeholder="请输入用户名" name="work_order" value="{{ old('work_order') }}" required autofocus>

                                @if ($errors->has('work_order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('work_order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="请输入密码" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    登录
                                </button>

                                {{-- <a class="btn btn-link"  href="{{ route('password.request') }}">
                                    忘记你的密码？
                                </a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
