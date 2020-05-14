<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Students extends Authenticatable
{
    use Notifiable;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guard    = 'students';
  protected $fillable = [
    'name', 'phone', 'password','msv','email','status','id_department','id_classes','id_branch'
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
  public function branches(){
    return $this->belongsTo('App\Model\Branches', 'id_branch', 'id');
   }
     public function classes(){
    return $this->belongsTo('App\Model\Classes', 'id_classes', 'id');
   }
}
