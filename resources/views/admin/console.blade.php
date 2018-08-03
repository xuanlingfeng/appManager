@extends('layouts.admin')

@section('nav')
    <li class="layui-nav-item"><a href="{{ url('/admin') }}">控制台</a></li>
@endsection

@section('content')
    <div class="" style="padding: 15px;">
        <blockquote class="layui-elem-quote">
            系统信息
        </blockquote>
        <table class="layui-table">
            <tbody>
                <tr>
                    <th>Web服务器：</th>
                    <td>{{ $_SERVER["SERVER_SOFTWARE"] }}</td>
                </tr>
                <tr>
                    <td>PHP版本：</td>
                    <td>{{ PHP_VERSION }}</td>
                </tr>
                <tr>
                    <th>GD库版本：</th>
                    <td>{{ gd_info()['GD Version'] }}</td>
                </tr>
                <tr>
                    <td>FreeType：</td>
                    <td>{{ gd_info()['FreeType Support'] ? '支持' : '不支持' }}</td>
                </tr>
                <tr>
                    <th>远程文件获取：</th>
                    <td>{{ ini_get('allow_url_fopen') ? '支持' : '不支持' }}</td>
                </tr>
                <tr>
                    <td>最大上传限制：</td>
                    <td>{{ ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'Disabled' }}</td>
                </tr>
                <tr>
                    <th>最大执行时间：</th>
                    <td>{{ ini_get('max_execution_time') . '秒' }}</td>
                </tr>
                <tr>
                    <td>服务器时间：</td>
                    <td>{{ date('Y-m-d H:i:s', time()) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
