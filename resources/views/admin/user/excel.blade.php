@extends('admin.right')

@section('content')
@if(!isset($model))
<blockquote class="layui-elem-quote">新增老师</blockquote>
@else
<blockquote class="layui-elem-quote">编辑老师</blockquote>
@endif

<div style="padding: 15px; width: 50%;">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/getTeacherExcel', $model->id], 'method' => 'PUT', 'id' => 'formCourse', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/getTeacherExcel', 'id' => 'formCourse', 'class' => 'layui-form']) !!}
	@endif
	<div class='copy'>
		<div class="layui-form-item">
		{!! Form::label('excel', '上传老师信息表', ['class' => 'layui-form-label']) !!}
		<button type="button" class="layui-btn" id="test" >上传老师信息表</button>	
		</div>
		<div class="layui-form-item">
		<input type="hidden" name="excel_url" id="excel_url">
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

<script id="uploadContainer" name="content" style="width:100%;height:350px;display:none;" type="text/template"></script>
@endsection

@section('js')
<script type="text/javascript">
function writeObj(obj){ 
 var description = ""; 
 for(var i in obj){ 
 var property=obj[i]; 
 description+=i+" = "+property+"\n"; 
 } 

//  document.getElementById('boxbox').outerHTML = description;

} 
function check(){
	// alert(event.currentTarget.id);
	writeObj(event.currentTarget);
}
function url_set(){
	var url;
	
	url_str = event.currentTarget.id;
}
    layui.use(['form','upload'], function() {
        var $ = layui.$,
		upload = layui.upload,
		form = layui.form;
		upload.render({
			elem: '#test'
			,url:'/api/excel'+ event.currentTarget.id
			,accept: 'file' //视频
			,method:'post'
			,done: function(res){
				console.log(res);
				$('#excel_url').attr('value',res.url);
				layer.msg('上传成功');
			},
			success:function(data){
				console.log(data);
			}
  		});
        //监听提交 
        form.on('submit(save)', function(data){
			$.post($('#formCourse').attr('action'), data.field, function(data, textStatus, xhr) {
				if(data.name!="这些老师已导入，请勿重复导入！"){
					layer.msg(data.name);
				}else{
					layer.msg(data.message);
				}
				// setTimeout(() => { window.location.href = document.referrer; }, 500);
			});
			return false;
	    });
	});
</script>
@endsection