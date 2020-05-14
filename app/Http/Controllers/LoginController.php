<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginPost;
use App\Http\Requests\StoreRegisterPost;
use Auth;
use Hash;
use App\User;
use App\Model\Department;
use App\Model\Lecturers;
use App\Model\Fields;
class LoginController extends Controller
{
    public function getDataDepartmentSelect( $current_id = '') {
      $category_data = Department::orderBy('created_at', 'asc')->get();
      $data_select   = "";

      foreach ($category_data as $category_item) {

          if ($current_id != "") {
            if ($category_item['id'] == $current_id) {
              $selected = "selected='selected'";
            } else {
              $selected = "";
            }
          } else {
            $selected = "";
          }
          $data_select .= '<option value="'.$category_item['id'].'" '.$selected.'>';
          $data_select .= $category_item['name'];
          $data_select .= '</option>';
       
      }
      return $data_select;
    }
    public function getLogin(){
    	return view('login');
    }
    public function postLogin(StoreLoginPost $req)
    {
      $validated = $req->validated();
      $data = $req->all();
      if (Auth::attempt(['email' =>$data['email'], 'password' => $data['password'], 'admin' => '1']) || Auth::guard('lecturers')->attempt(['email_address_lecturer' =>$data['email'], 'password' => $data['password'], 'status' => '1'])) {
        return redirect('/');  
      }
      else {
        return redirect('login')->with('flash_message_error','Tài khoản hoặc mật khẩu  sai');    
      }
    }
    public function logout(){
      Auth::logout();
      return redirect('login');
    }
    public function register()
    {
     $data_depart_select   = $this->getDataDepartmentSelect();
     $fields = Fields::get();
     return view('register')->with('data_depart_select',$data_depart_select)->with('fields', $fields);
    }
    public function registerpost(StoreRegisterPost $req)
    {
      $validated = $req->validated();
      $lecturers = new Lecturers();
      $lecturers->name_lecturer = $req->name;
      $lecturers->address_lecturer = $req->address;
      $lecturers->email_address_lecturer = $req->email;
      $lecturers->phone_number = $req->phone;
      $lecturers->password = Hash::make($req->password);
      $lecturers->id_department = $req->department;
      $lecturers->id_field = $req->fields;
      if ($lecturers->save()) {
        return redirect('register-teacher')->with('flash_message_success','Bạn đã đăng kí thành công. Hãy đợi người quản lý duyệt');
      }
      else{
         return redirect('register-teacher')->with('flash_message_error','Có lỗi xảy ra. Vui lòng thử lại');
      }
    }
}
