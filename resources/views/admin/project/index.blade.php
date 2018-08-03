@extends('admin.right')

@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">项目管理 
            <div style="float: right;">
                <a href="{{ url('admin/project/create') }}" class="layui-btn layui-btn-small">新增一级项目</a>
            </div>
        </blockquote>
        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>父级栏目</th>
                    <th>项目名称</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    @if((count($project->childProject))>0) 
                    <td>|--&nbsp&nbsp&nbsp{{ $project->childProject[0]['name'] }}</td>
                    @else
                    <td>一级栏目</td>
                    @endif
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/project/'.$project->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        <a href="{{url('admin/project/del/'.$project->id)}}" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                        <a href="{{ url('admin/project/add/'.$project->id) }}" class="layui-btn  layui-btn-mini">新增下级</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $projects->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection
