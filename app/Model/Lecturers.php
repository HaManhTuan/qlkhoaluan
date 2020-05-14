<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lecturers extends Authenticatable
{
  use Notifiable;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guard    = 'lecturers';
  protected $fillable = [
  'name_lecturer','email_address_lecturer','password','status','address_lecturer','phone_number','id_department','id_field'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  public function department(){
    return $this->belongsTo('App\Model\Department', 'id_department', 'id');
   }
  public function field(){
    return $this->belongsTo('App\Model\Fields', 'id_field', 'id');
   }
   public function topics()
   {
     return $this->hasMany('App\Model\Topics', 'lecturers_id');
   }
}
