<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use Hash;
class UserController extends Controller
{
  public function add()
  {
    $roles = Role::get()->pluck('name', 'name');
    return view('qltaikhoan.add', compact('roles'));
  }
  public function postadd(Request $req)
  {
     $count_email = User::where('email',$req->email)->count();
        if ($count_email > 0) {
            return redirect('add-user')->with('flash_message_error','Email này đã tồn tại
            ');
        }
        else{
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
            $user->admin = $req->input('admin') ? '1' : '0';
            $roles = $req->input('roles') ? $req->input('roles') : [];
            $user->save();
            $user->assignRole($roles);
            // $user->givePermissionTo();
            return redirect('/taikhoan')->with('flash_message_success','Thêm thành công !');
        }
  }
  public function edit($id){
        // if (! Gate::allows('edit_user')) {
        //     return view('backend.errors.401');
        // }
        $dataUserId = User::find($id);
        $roles = Role::get()->pluck('name', 'name');
        return view('qltaikhoan.edit', compact('dataUserId','roles'));
  }
  public function postedit(Request $req){
        $user = User::find($req->user_id);
        $user->name = $req->name;
        $user->phone = $req->phone;
        if(isset($req->password) && $req->password !=""){
            $user->password = Hash::make($req->password);
        }
        $user->admin = $req->input('admin') ? '1' : '0';
        $user->save();
        $roles = $req->input('roles') ? $req->input('roles') : [];
        $user->syncRoles($roles);
        return redirect('taikhoan')->with('flash_message_success','Sửa thành công !');
    }
    public function deleteuser(Request $req){
      if (User::destroy($req->id)) {
        $msg = array(
          'status' => '_success',
          'msg'    => 'Đã xóa',
        );
        return json_encode($msg);
      } else {
        $msg = array(
          'status' => '_error',
          'msg'    => 'An error occurred. Please try again',
        );
        return json_encode($msg);
      }
    }
}
