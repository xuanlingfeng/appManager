<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\City;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(City $city){
        $this->city = $city;
    }
    public function index()
    {
        $citys = $this->city->paginate(15);
        return view('admin.city.index',compact('citys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citys = $this->city->get();
        return view('admin.city.form', compact('citys'));
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
        $re = $this->city->where('name',$all['name'])->first();
        if(count($re)!=0){
            return response()->json(['message'=>'该城市已存在，请勿重复添加！']);
        }else{
            $citys = $this->city->create($all);
            if($citys){
                return response()->json(['message'=>'城市添加成功'],200);
            }else{
                return response()->json(['message'=>'城市添加失败'],201);
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
        $model = $this->city->find($id);
        return view('admin.city.form', compact('model'));
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
        $citys = $this->city->find($id);  // 查到要修改的部分
        if ($citys->update($all)) {
            return response()->json(['info' => '修改城市成功']);
        }else{
            return response()->json(['info' => '修改城市失败']);
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
        $citys = $this->city->find($id);
        $result = $citys->delete();
        if ($result) {
            return back()->with('success', '删除城市成功。');
        }
        return back()->with('fail', '删除城市失败。'); 
    }
}
