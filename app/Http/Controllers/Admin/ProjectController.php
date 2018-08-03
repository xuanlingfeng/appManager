<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Project;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Project $project){
        $this->project = $project;
    }
    public function index()
    {

        $projects = $this->project->with('childProject')->paginate(15);
        return view('Admin.project.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //.
        $projects = $this->project->where('parent_id',0)->orderBy('created_at','desc')->get();
        return view('admin.project.form',compact('projects'));

    }
    public function add($id)
    {
        $parent_project = $this->project->where('id',$id)->first();
        return view('admin.project.form',compact('parent_project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $all = $request->all();
        if($all['parent_id'] == null){
            $all['parent_id'] = 0;
        }
        
        $re = $this->project->where('name',$all['name'])->first();
        if(count($re)!=0){
            return response()->json(['message'=>'该项目已存在，请勿重复添加！']);
        }else{
            $project = $this->project->create($all);
            if($project){
                return response()->json(['info'=>'项目添加成功'],200);
            }else{
                return response()->json(['info'=>'项目添加失败'],201);
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
        $model = $this->project->with('childProject')->find($id);
        $p_id = $model->parent_id;
        if($p_id != 0){
            $parent_id = $this->project->where('id',$p_id)->first()->parent_id;
            $projects = $this->project->where('parent_id',$parent_id)->orderBy('created_at','desc')->get();
        }
        return view('admin.project.form', compact('model','projects'));

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
        //
        $all = $request->all();
        $projects = $this->project->find($id);  // 查到要修改的部分
        if ($projects->update($all)) {
            return response()->json(['info' => '修改项目成功']);
        }else{
            return response()->json(['info' => '修改项目失败']);
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
        $project = $this->project->find($id);
        $del_Id = $this->findChild($id);
        $del_Id[] = intval($id);
        $projects = $this->project->whereIn('id',$del_Id)->get();
        foreach($projects as $project){
            $result = $project->delete();
        }
        if ($result) {
            return back()->with('success', '删除活动成功。');
        }
        return back()->with('fail', '删除活动失败。');
    }
    public function findChild($id){
        $project = $this->project->where('parent_id',$id)->get();
        if(count($project) > 0){
            $p_id = array();
        foreach($project as $p){
            $GLOBALS['p_id'][] = $p->id;
                $p_id[] = $p->id;
            }
        if(count($p_id) > 0 ){
            foreach($p_id as $id){
                $this->findChild($id);
                }
            } 
        }  
        return $GLOBALS['p_id'];
    }
}
