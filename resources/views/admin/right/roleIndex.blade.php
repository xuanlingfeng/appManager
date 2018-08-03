@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">{{ $title }}
	<a href="{{ route('role.create') }}" class="layui-btn layui-btn-small" style="float: right; margin-right: 5px;"><i class="layui-icon">&#xe608;</i> 添加角色</a>
</blockquote>
	
	<table class="layui-table">
	    <thead>
	        <tr>
	            <th>角色</th>
	            <th>角色名称</th>
	            <th>角色详情</th>
	            <th>操作</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach ($roles as $role)
	        <tr>
	            <td>{{ $role->name }}</td>
	            <td>{{ $role->display_name }}</td>
				<td>{{ $role->description }}</td>
	            <td>
	            	{{-- 如果不是超级管理员 --}}
	            	@if ($role->name !== 'admin')
					<a href="{{ url('admin/role/'.$role->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
					<a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-role{{ $role->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>	                
 					{!! Form::open(['route' => ['role.destroy', $role->id], 'id' => 'destroy-role'.$role->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                    {!! Form::close() !!}	            	
	            	@endif                
	            </td>
	        </tr>
	        @endforeach
	    </tbody>
    </table>
    <div id="pages" style="margin: 0 auto; text-align: center;">{{ $roles->links() }}</div>
    <div id="myInfo" style="display: none"></div>
@endsection



