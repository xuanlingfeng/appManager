<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    //
    protected $table = 'campus';

    protected $fillable = ['city_id','sch_name'];


 public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


}
