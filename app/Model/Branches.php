<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
     protected $table    = 'branches';
     public function department(){
      return $this->belongsTo('App\Model\Department', 'department_id', 'id');
     }
}
