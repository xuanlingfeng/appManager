@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">新增项目</blockquote>
<div style="padding: 15px; width: 40%;">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@if (isset($model))
	
	{!! Form::model($model, ['url' => ['/admin/project', $model->id], 'method' => 'PUT', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/project', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@endif
	@if(isset($parent_project ) || count($model->childProject)>0)
	<div class="layui-form-item">
		<label class="layui-form-label" >课程阶段</label>
		<div class="layui-input-block">
			<select name="parent_id"  lay-filter="parent_id"  id="parent_id" >
			@if(isset($parent_project))
			<option value="{{ $parent_project->id }}">{{ $parent_project->name }}</option>
			@endif
			@if(isset($model))
				@if(count($model->childProject)>0)
				<option value="{{ $model->childProject[0]->id }}">{{ $model->childProject[0]->name }}</option>
				@foreach($projects as $project)
					<option value="{{ $project->id }}">{{ $project->name }}</option>	
				@endforeach
				@endif
			@endif
			</select>
		</div>
	</div>
	@endif
	<div class="layui-form-item">
		{!! Form::label('name', '项目名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入项目名称', 'class' => 'layui-input']) !!}
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
				// setTimeout(() => { window.location.href = document.referrer; }, 500);
			});
			return false;
	    });
 		form.on('select(parent_id)', function(data){
			console.log(data.value);
			console.log($(this));
			var val=data.value;
				$.ajax({
					type: "POST",
					url: "{{url('admin/postProject')}}",
					data: {id:data.value},
					dataType: "json",
					headers: {
        				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    				},
					success: function(data){
						// console.log(data);

						if(data.length!=0){
							$('.menu').append('<div class="layui-form-item menu1"><label class="layui-form-label">上级菜单</label><div class="layui-input-block"><select name="parent_id" lay-filter="parent_id"  class="fenlei1"><option value="'+val+'">请选择</option>');
							for(var i=0;i<data.length;i++ ){
							$('.fenlei1').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
							}
							$('.menu1').append('</select></div></div>');
						}else{
							$('.menu').append('');
						}
						form.render(); //更新全部
                      }
        		});
			});

	});





</script>
@endsection