<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'project';

    protected $fillable = ['parent_id','name'];

    
    public function childProject() {
        return $this->hasMany('App\Models\Project', 'id', 'parent_id');
    }
 
    public function allChildrenProjects()
    {
        return $this->childProject()->with('allChildrenProjects');
    }

}
