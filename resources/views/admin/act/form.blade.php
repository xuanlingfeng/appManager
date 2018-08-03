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
	{!! Form::model($model, ['url' => ['/admin/act', $model->id], 'method' => 'PUT', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/act', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		<label class="layui-form-label" >活动类型</label>
		<div class="layui-input-block">
		
			<select name="c_id"  lay-filter="c_id"  id="c_id" >
			@if(isset($model))
			<option value="{{$model->actClass->id}}">{{$model->actClass->title}}</option>
			@foreach($actClasss as $actClass)
			<option value="{{$actClass->id}}">{{ $actClass->title}}</option>
			@endforeach	
			@else
			<option value="">请选择</option>
			@foreach ($actClasss as $actClass)
			<option value="{{$actClass->id}}">{{ $actClass->title}}</option>
			@endforeach
			@endif
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('name', '活动名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入活动名称', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('longitude', '活动经度', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('longitude', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入活动地点经度', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('latitude', '活动纬度', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('latitude', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入活动地点纬度', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-inline">
			{!! Form::label('status', '状态', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::radio('status', 1, isset($model) ? $model->status : true, ['title' => '有效']) !!}
				{!! Form::radio('status', 0, isset($model) ? $model->status : null, ['title' => '作废']) !!}
			</div>
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