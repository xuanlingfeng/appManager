@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">新增校区</blockquote>
<div style="padding: 15px; width: 50%;">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/campus', $model->id], 'method' => 'PUT', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/campus', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
   		<label class="layui-form-label">所属城市</label>
		<div class="layui-input-block">
		<select name="city_id"   lay-filter="city_id">
			@if(isset($model))
				<option value="{{$model->city_id}}">{{ $model->city->name }}</option>
				@foreach ($citys as $city )
				<option value="{{$city->id}}">{{ $city->name }}</option>
				@endforeach
			@else
				@foreach ($citys as $city )
				<option value=""></option>
				<option value="{{$city->id}}">{{ $city->name }}</option>
				@endforeach
			@endif
		</select>
		</div>
 	</div>
	<div class="layui-form-item">
		{!! Form::label('sch_name', '校区名', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('sch_name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入校区名', 'class' => 'layui-input']) !!}
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