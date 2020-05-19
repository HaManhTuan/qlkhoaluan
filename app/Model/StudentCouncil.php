<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentCouncil extends Model
{
  protected $table ='student_council';
   protected $fillable = [
    'name','msv','topic','id_topic','lecturer','id_lecturer','council'
  ];
}
