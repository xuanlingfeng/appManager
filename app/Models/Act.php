<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    //
    protected $table = 'act';

    protected $fillable = ['c_id','name','longitude','latitude','status'];

    public  function actClass()
    {
        return $this->belongsTo(ActClass::class, 'c_id', 'id');
    }


}
