<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
  protected $table    = 'topics';
  protected $fillable = [
  'lecturers_id','fields_id','name','accept','description'
  ];
     public function branches(){
      return $this->belongsTo('App\Model\Lecturers', 'lecturers_id', 'id');
     }
}
