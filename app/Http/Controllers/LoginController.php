<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginPost;
use Auth;
use App\User;
class LoginController extends Controller
{
    public function getLogin(){
    	return view('login');
    }
    public function postLogin(StoreLoginPost $req)
    {
      $validated = $req->validated();
      $data = $req->all();
      if (Auth::attempt(['email' =>$data['email'], 'password' => $data['password'], 'admin' => '1'])) {
        return redirect('index');  
      }
      else {
        return redirect('login')->with('flash_message_error','Tài khoản hoặc mật khẩu  sai');    
      }
    }
    public function logout(){
      Auth::logout();
      return redirect('login');
    }
}
