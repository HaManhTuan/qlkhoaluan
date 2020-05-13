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
}
