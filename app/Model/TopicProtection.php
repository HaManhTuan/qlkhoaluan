<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TopicProtection extends Model
{
    protected $table    = 'topic_protection';
    public function topics()
    {
      return $this->belongsTo('App\Model\Topics', 'id_topic', 'id');
    }
    public function students()
    {
      return $this->belongsTo('App\Model\Students', 'id_student', 'id');
    }
    public function protections()
    {
      return $this->belongsTo('App\Model\Protections', 'id_protection', 'id');
    }
}
