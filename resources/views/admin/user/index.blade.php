@extends('admin.right')

@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">用户管理 
            <div style="float: right;">
                <a href="{{ url('admin/user/create') }}" class="layui-btn layui-btn-small">新增用户</a>
            </div>
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>姓名</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
   
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->work_order }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/user/'.$user->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        <a href="{{url('admin/user/del/'.$user->id)}}" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $users->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection
