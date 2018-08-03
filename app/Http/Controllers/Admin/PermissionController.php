<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Permission;

/**
 * 权限管理
 * 
 * 作者：宣凌峰
 * 时间：2018年5月26日
 */

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
    	$this->permission = $permission;
    }

    public function index()
    {
        $title = '权限管理';
        $permissions = $this->permission->get();
        return view('admin.right.permissionIndex', compact('title', 'permissions'));
    }

    public function create()
    {
        $title = '添加权限';
        return view('admin.right.permissionForm', compact('title'));
    }

    public function store(Request $request)
    {
        $all = $request->all();
        if($this->permission->create($all)){
            return response()->json(['info'=>'添加权限成功']);
        }
        return response()->json(['info'=>'添加权限失败']);

    }

    public function edit($id)
    {
        $title = '修改权限信息';
        $model = $this->permission->find($id);
        return view('admin.right.permissionForm', compact('model', 'title'));
    }
    public function update(Request $request ,$id)
    {
        $all = $request->all();
        if ($this->permission->find($id)->update($all)) {
            return response()->json(['info'=>'修改权限信息成功']);
        }
        return response()->json(['info'=>'修改权限信息失败']);
    }

    public function destroy($id){
        $this->permission->find($id)->delete();
        return back();        
    }
}
