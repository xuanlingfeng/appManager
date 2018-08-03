@extends('admin.right')

@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">校区管理 
            <div style="float: right;">
                <a href="{{ url('admin/campus/create') }}" class="layui-btn layui-btn-small">新增校区</a>
            </div>
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>所属城市</th>
                    <th>校区名</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campus as $campu)
                <tr>
                    <td>{{ $campu->id }}</td>
                    <td>{{ $campu->city->name }}</td>
                    <td>{{ $campu->sch_name }}</td>
                    <td>{{ $campu->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/campus/'.$campu->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        <a href="{{url('admin/campus/del/'.$campu->id)}}" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $campus->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection
