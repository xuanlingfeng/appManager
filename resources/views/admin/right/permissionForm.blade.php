@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">{{ $title }}</blockquote>
<div style="padding: 15px; width: 50%;">

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
	{!! Form::model($model, ['url' => ['/admin/permission', $model->id], 'method' => 'PUT', 'id' => 'formPermission', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/permission', 'id' => 'formPermission', 'class' => 'layui-form']) !!}
	@endif

	<div class="layui-form-item">
		{!! Form::label('name', '权限', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入权限的唯一名称', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('display_name', '权限名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('display_name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入人类可读的权限名', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('description', '权限描述', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('description', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入该权限的详细描述', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			{!! Form::button('提交', ['class' => 'layui-btn', 'lay-submit' => '', 'lay-filter' => 'save']) !!}
			{!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection

@section('js')
<script type="text/javascript">
    layui.use(['form'], function() {
        var $ = layui.$,
		form = layui.form;

        // 监听提交
        form.on('submit(save)', function(data){
			$.post($('#formPermission').attr('action'), data.field, function(data, textStatus, xhr) {
				layer.msg(data.info);
				setTimeout(() => { window.location.href = document.referrer; }, 500);
			});
			return false;
	    });
	});
</script>
@endsection