@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">新增城市</blockquote>
<div style="padding: 15px; width: 50%;">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/actClass', $model->id], 'method' => 'PUT', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/actClass', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		{!! Form::label('title', '活动类型', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('title', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入活动类型', 'class' => 'layui-input']) !!}
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
        //监听提交
        form.on('submit(save)', function(data){
			$.post($('#formUser').attr('action'), data.field, function(data, textStatus, xhr) {
				layer.msg(data.info);
				setTimeout(() => { window.location.href = document.referrer; }, 500);
			});
			return false;
	    });
	});
</script>
@endsection