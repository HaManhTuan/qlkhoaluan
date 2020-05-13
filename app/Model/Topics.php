<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
  protected $table    = 'topics';
     public function branches(){
      return $this->belongsTo('App\Model\Lecturers', 'lecturers_id', 'id');
     }
}
