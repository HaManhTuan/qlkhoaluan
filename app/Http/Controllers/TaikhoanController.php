<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
class TaikhoanController extends Controller
{
    public function getTaikhoan(){
      $dataUser = User::all();
      $roles = Role::get()->pluck('name', 'name');
      $data_send = ['dataUser' => $dataUser,
        'roles' => $roles ];
    	return view('qltaikhoan.taikhoan',  compact('dataUser','roles'));
    }

}
