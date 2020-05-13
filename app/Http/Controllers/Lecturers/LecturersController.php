<?php

namespace App\Http\Controllers\Lecturers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginLecPost;
use Auth;
class LecturersController extends Controller
{
  public function login()
  {
    return view('lecturers.auth.login');
  }
  public function dangnhap(StoreLoginLecPost $req)
  {
    $validated = $req->validated();
    $data = $req->all();
    if (Auth::guard('lecturers')->attempt(['email_address_lecturer' =>$data['email'], 'password' => $data['password'], 'status' => '1'])) {
      return redirect('lecturers/dashboard');  
    }
    else {
      return redirect('lecturers/login')->with('flash_message_error','Tài khoản hoặc mật khẩu  sai');    
    }
  }
}
