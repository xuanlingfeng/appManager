@extends('admin.right')

@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">活动管理 
            <div style="float: right;">
                <a href="{{ url('admin/act/create') }}" class="layui-btn layui-btn-small">新增活动</a>
            </div>
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>活动类型</th>
                    <th>活动名称</th>
                    <th>活动地点经度</th>
                    <th>活动地点纬度</th>
                    <th>活动状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($acts as $act)
                <tr>
                    <td>{{ $act->id }}</td>
                    <td>{{ $act->actClass->title }}</td>
                    <td>{{ $act->name }}</td>
                    <td>{{ $act->longitude }}</td>
                    <td>{{ $act->latitude }}</td>
                    <td> @if($act->status==1)活动有效@else活动作废 @endif</td>
                    <td>{{ $act->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/act/'.$act->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        <a href="{{url('admin/act/del/'.$act->id)}}" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $acts->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection
