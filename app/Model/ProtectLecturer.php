<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProtectLecturer extends Model
{
    //protect_lecturer
    protected $table    = 'protect_lecturer';
    public function protect()
    {
      return $this->belongsTo('App\Model\Protections', 'id_protect', 'id');
    }
    public function lecturer()
    {
      return $this->belongsTo('App\Model\Lecturers', 'id_lecture', 'id');
    }
}
