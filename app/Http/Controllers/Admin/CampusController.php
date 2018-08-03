<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Campus;
use App\Models\City;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Campus $campus,City $city){
        $this->campus = $campus;
        $this->city = $city;
    }

    public function index()
    {
        $campus = $this->campus->with('city')->paginate(15);
        return view('admin/campus/index',compact('campus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campus = $this->campus->get();
        $citys = $this->city->get();
        return view('admin.campus.form', compact('campus','citys'));
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
        $re = $this->campus->where('sch_name',$all['sch_name'])->first();
        if(count($re)!=0){
            return response()->json(['message'=>'该校区已存在，请勿重复添加！']);
        }else{
            $campus = $this->campus->create($all);
            if($campus){
                return response()->json(['info'=>'校区添加成功'],200);
            }else{
                return response()->json(['info'=>'添加校区失败'],201);
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
        $model = $this->campus->with('city')->find($id);
        $citys = $this->city->get();
        return view('admin.campus.form', compact('model','citys'));
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
        $campus = $this->campus->find($id);  // 查到要修改的部分
        if ($campus->update($all)) {
            return response()->json(['info' => '修改校区成功']);
        }else{
            return response()->json(['info' => '修改校区失败']);
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
        $campus = $this->campus->find($id);
        $result = $campus->delete();
        if ($result) {
            return back()->with('success', '删除校区成功。');
        }
        return back()->with('fail', '删除校区失败。'); 
    }
}
