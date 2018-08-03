@extends('admin.right')

@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">城市管理 
            <div style="float: right;">
                <a href="{{ url('admin/city/create') }}" class="layui-btn layui-btn-small">新增城市</a>
            </div>
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>城市名称</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citys as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/city/'.$city->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        <a href="{{url('admin/city/del/'.$city->id)}}" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $citys->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection
