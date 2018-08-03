<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Http\Requests\UserRules;
use App\Http\Requests\PasswordRules;
use App\Models\configure;
/**
 * 用户管理
 * 
 * 作者：宣凌峰
 * 时间：2018年5月26日
 */

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;
    private $role;
    private $permission;

    public function __construct(User $user, Role $role )
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate(15);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 返回到用户表单
        $roles = $this->role->get();
        return view('admin.user.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();
       $all['password']=bcrypt($all['password']);

        if ($users = $this->user->create($all)) {  // 如果添加成功
            //  给当前用户绑定角色
            $users->attachRole($all['roles']);  //  后面只填入id

            return response()->json(['info' => '添加用户成功']);
        }
        // 添加失败
        return response()->json(['info'  => '添加用户失败']);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = $this->user->with('roles')->find($id);
        // dd($model);
        $roles = $this->role->get();    
        return view('admin.user.form', compact('model', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $all = $request->all();
        $user = $this->user->find($id);  // 查到要修改的部分
        if ($user->update($all)) {
            $user->detachRoles();  //  先移除
            $user->attachRole($all['roles']);  //  再添加
            return response()->json(['info' => '修改用户成功']);
        }else{
            return response()->json(['info' => '修改用户失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //   删除一个用户，是真的删除
    public function destroy($id)
    {
        $user = $this->user->find($id);
        if ($user->hasRole('Admin')) {
            return back()->with('fail', '不能删除管理员用户。');
        }
        $result = $user->delete();
        if ($result) {
            return back()->with('success', '删除用户成功。');
        }
        return back()->with('fail', '删除用户失败。');    
    }

    //  修改密码
    public function changePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all(); //接收所有的数据
            $user = Auth::user();
            if (!Hash::check($data['oldpassword'], $user->password)) {  // 密码验证  // 未加密，和加密的进行验证

                return response()->json(['info'=>'原始密码错误']);
            }

            if ($data['password'] !== $data['password_confirmation']) {

                return response()->json(['info'=>'两次输入密码不一致']);
            }

            $user->password = bcrypt($data['password']);

            if ($user->save()) {
                Auth::logout(); 
                return response()->json(['info' => '密码修改成功']);
            }
        }
    }

    public function sendrole(Request $request){
        $all = $request->all();
        $data = $this->role->find($all['id']);
        return $data;
    }
    public function sendproj(Request $request){
        $all = $request->all();
        $data=$this->classes->where('proj_id',$all['id'])->get();
        return $data;
    }



}
