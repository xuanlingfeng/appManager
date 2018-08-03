<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Act;
use App\Models\ActClass;

class ActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Act $act , ActClass $actClass){
            $this->act = $act;
            $this->actClass = $actClass;
    }

    public function index()
    {
        $acts = $this->act->with('actClass')->orderBy('created_at','desc')->paginate(15);
        return view('admin.act.index',compact('acts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acts = $this->act->get();
        $actClasss = $this->actClass->orderBy('created_at','desc')->get();
        return view('admin.act.form', compact('acts','actClasss'));
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
        $re = $this->act->where('c_id',$all['c_id'])->where('name',$all['name'])->where('longitude',$all['longitude'])->where('latitude',$all['latitude'])->first();
        if(count($re)!=0){
            return response()->json(['message'=>'该活动已存在，请勿重复添加！']);
        }else{
            $acts = $this->act->create($all);
            if($acts){
                return response()->json(['message'=>'活动添加成功'],200);
            }else{
                return response()->json(['message'=>'活动添加失败'],201);
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
        $model = $this->act->with('actClass')->find($id);
        $actClasss = $this->actClass->get();
        return view('admin.act.form', compact('model','actClasss'));
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
        $acts = $this->act->find($id);  // 查到要修改的部分
        if ($acts->update($all)) {
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
        $act = $this->act->find($id);
        $result = $act->delete();
        if ($result) {
            return back()->with('success', '删除活动类型成功。');
        }
        return back()->with('fail', '删除活动类型失败。');
    }
}
