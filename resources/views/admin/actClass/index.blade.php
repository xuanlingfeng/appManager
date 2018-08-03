@extends('admin.right')

@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">活动类型管理 
            <div style="float: right;">
                <a href="{{ url('admin/actClass/create') }}" class="layui-btn layui-btn-small">新增活动类型</a>
            </div>
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>活动类型</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actClasss as $actClass)
                <tr>
                    <td>{{ $actClass->id }}</td>
                    <td>{{ $actClass->title }}</td>
                    <td>{{ $actClass->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/actClass/'.$actClass->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        <a href="{{url('admin/actClass/del/'.$actClass->id)}}" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $actClasss->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection
