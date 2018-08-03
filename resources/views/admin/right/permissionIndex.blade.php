@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">{{ $title }}</blockquote>
<table class="layui-table" style="width: 90%; margin: 0 auto;">
    <thead>
        <tr>
            <th>id</th>
            <th>权限</th>
            <th>权限名称</th>
            <th>权限说明</th>
            <th>操作<a href="{{ route('permission.create') }}" class="layui-btn layui-btn-mini" style="float: right; margin-right: 5px;"><i class="layui-icon">&#xe608;</i> 添加</a></th>
        </tr>
    </thead>

    <tbody>
    @if(isset($permissions))	
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->display_name }}</td>
            <td>{{ $permission->description }}</td>
            <td>
            	<a href="{{ route('permission.edit', $permission->id) }}" class="layui-btn layui-btn-mini">编辑</a>
               	<a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-role{{ $permission->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                {!! Form::open(['route' => ['permission.destroy', $permission->id], 'id' => 'destroy-role'.$permission->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                {!! Form::close() !!} 
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
@endsection

@section('js')
@endsection