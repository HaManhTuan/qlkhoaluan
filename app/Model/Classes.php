<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
     protected $table    = 'classes';
     public function department(){
      return $this->belongsTo('App\Model\Department', 'department_id', 'id');
     }
     public function branches(){
      return $this->belongsTo('App\Model\Branches', 'branch_id', 'id');
     }
}
