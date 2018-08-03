@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">新增用户</blockquote>
<div style="padding: 15px; width: 50%;">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/user', $model->id], 'method' => 'PUT', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/user', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		{!! Form::label('work_order', '用户名', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('work_order', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入用户名', 'class' => 'layui-input']) !!}
		</div>
	</div>
	@if(!isset($model))
	<div class="layui-form-item">
		{!! Form::label('password', '密码', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::password('password', ['lay-verify' => 'pass', 'autocomplete' => 'off', 'placeholder' => '请输入密码,至少是6位数', 'class' => 'layui-input']) !!}
		</div>
	</div>
	@endif
	@if(isset($model->roles[0]))
	<div class="layui-form-item" style='position:relative;'>
   		<label class="layui-form-label">选择角色</label>
		<div class="layui-input-block">
		<select name='roles'  id="role"  lay-filter="role">
				<option value="{{$model->roles[0]->id}}">{{ $model->roles[0]->display_name }}</option>
				@foreach ($roles as $role )
				<option value="{{$role->id}}">{{ $role->display_name }}</option>
				@endforeach
		</select>
		</div>
		@if(isset($model))
		<span  style='float:right;position:absolute;right:-160px;top:0;line-height:38px;width:150px;height:38px;'>{{$model->roles[0]->display_name}}</span>
		@endif
 	</div>
	@else
	<div class="layui-form-item">
   		<label class="layui-form-label">选择角色</label>
		<div class="layui-input-block">
		<select name='roles'  id="role"  lay-filter="role">
				<option value="">请选择</option>
				@foreach ($roles as $role )
				<option value="{{$role->id}}">{{ $role->display_name }}</option>
				@endforeach
		</select>
		</div>

 	</div>
	@endif
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
<script type="text/javascript" src="{{ asset('libs/layui/laydate.js') }}"></script>
<script type="text/javascript">
    layui.use(['form','laydate'], function() {
        var $ = layui.$,
		form = layui.form;
		laydate = layui.laydate,
		laydate.render({
				elem: '#time' //指定元素
				,type: 'datetime'
				,done:function(value,date){
						console.log(value);
						$("#time").attr("value",value);
						form.render(); //更新全部
					}
				});
  		form.verify({
                pass: function(value){
                    if(value.length < 6){
                        return '密码至少是6位数';
                    }
                }
            });
			form.on('select(role)', function(data){
				// alert(data.value);
				$.ajax({
					type: "POST",
					url: "{{url('admin/sendrole')}}",
					data: {id:$("#role").val()},
					dataType: "json",
					headers: {
        				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    				},
					success: function(data){
					
						console.log(data.name);
						if(data.name == "user"){
							$('#shixian').attr('style','display:block;');

						}else{
							$('#shixian').attr('style','display:none;');
						}
						form.render(); //更新全部
                      }
        		});
			});
			form.on('select(proj_id)', function(data){
				// alert(data.value);
				$.ajax({
					type: "POST",
					url: "{{url('admin/sendproj')}}",
					data: {id:$("#proj_id").val()},
					dataType: "json",
					headers: {
        				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    				},
					success: function(data){
						$('#classes>.classes').html('');
						$('#classes>div>label').attr('style','display:none;');
						data.forEach(function(value, index, array){
						//执行某些操作
							$('#classes>.classes').append(' <input type="checkbox" name="classes['+index+']" value="'+value.id+'" lay-skin="primary" title="'+value.code+'" >');
						})	
						form.render(); //更新全部
                      }
        		});
			});

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