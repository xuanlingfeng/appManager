@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">{{ $title }}</blockquote>
<div style="padding: 10px; width: 40%; float: left; border: 1px solid #eee; border-radius: 8px;">
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/role', $model->id], 'method' => 'PUT', 'id' => 'formRole', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/role', 'id' => 'formRole', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		{!! Form::label('name', '角色', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入角色的唯一名称，如“admin”，“owner”，“employee”等', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('display_name', '角色名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('display_name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入人类可读的角色名，例如“后台管理员”、“作者”、“雇主”等', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('description', '角色描述', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('description', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入该角色的详细描述', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
 			{{-- 正主隐藏在这里 --}}
            {!! Form::hidden('permissions', isset($model) ? implode(',', $model->perms()->pluck('id')->toArray()) : null) !!}			
			{!! Form::submit('提交', ['class' => 'layui-btn', 'lay-submit' => '', 'lay-filter' => 'save']) !!}
			{!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
<div style="width: 55%; float: right;">
	<table class="layui-table">
	  	<thead>
		    <tr>
		      	<th style="width: 100px;">权限名称</th>
		      	<th>行为</th>
		    </tr> 
	  	</thead>
	  	<tbody>
	  	@foreach ($permissions as $permission)
	 	<tr>
	      	<td>{{ $permission->display_name }}</td>
	      	<td>
	      		 {{-- in_array()函数在数组中搜索给定的值
				当前的id值   是不是在表中存在，进行判断,  诺有则返回true，没有就返回false --}}
	      		{!! Form::checkbox($permission->id, null, isset($model) && in_array($permission->id, $model->perms()->pluck('id')->toArray()) ? true : null) !!} 授予权限
	      	</td>
	    </tr>
		@endforeach
	  	</tbody>
	</table>
</div>
@endsection
@section('js')
<script type="text/javascript">
    layui.use(['form'], function() {
        var $ = layui.$,
		form = layui.form;

        // 监听提交
        form.on('submit(save)', function(data){
			$.post($('#formRole').attr('action'), data.field, function(data, textStatus, xhr) {
				layer.msg(data.info);
				setTimeout(() => { window.location.href = document.referrer; }, 500);
			});
			return false;
	    });
	});

    var chkIds = {{ isset($model) ? json_encode($model->perms()->pluck('id')->toArray()) : '[]' }},  //  如果是修改状态  默认为空
        s = $('input:checkbox'),  // 选择
        c = $('input:checkbox:checked');  // 已选中的
    $(function() {
        s.each(function(i) {
            $(this).click(function(){
                if (this.checked) { // 如果是已经选中的   
                    chkIds.push(this.name);  //  数组增加元素
                } else {
                    chkIds.splice($.inArray(this.name, chkIds), 1);
                }
                $('input[name=permissions]').val(chkIds);  // 隐藏的文本框赋值
            });
        });
    });
</script>
@endsection