<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActClass;

class ActClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(ActClass $actClass){
        $this->actClass = $actClass;
    }

    public function index()
    {
        $actClasss = $this->actClass->paginate(15);
        return view('admin.actClass.index', compact('actClasss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actClasss = $this->actClass->get();
        return view('admin.actClass.form', compact('actClass'));
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
        $re = $this->actClass->where('title',$all['title'])->first();
        if(count($re)!=0){
            return response()->json(['message'=>'该活动类型已存在，请勿重复添加！']);
        }else{
            $actClasss = $this->actClass->create($all);
            if($actClasss){
                return response()->json(['message'=>'活动类型添加成功'],200);
            }else{
                return response()->json(['message'=>'活动类型添加失败'],201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->actClass->find($id);
        return view('admin.actClass.form', compact('model'));
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
        $actClasss = $this->actClass->find($id);  // 查到要修改的部分
        if ($actClasss->update($all)) {
            return response()->json(['info' => '修改活动类型成功']);
        }else{
            return response()->json(['info' => '修改活动类型失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actClasss = $this->actClass->find($id);
        $result = $actClasss->delete();
        if ($result) {
            return back()->with('success', '删除活动类型成功。');
        }
        return back()->with('fail', '删除活动类型失败。'); 

    }
}
