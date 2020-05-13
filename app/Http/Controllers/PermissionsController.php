<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }
    public function add(){
        if (! Gate::allows('add_user')) {
            return view('backend.errors.401');
        }
        return view('backend.permissions.add');
    }
    public function postadd(Request $req){
    
        if ( Permission::create($req->all())) {
             $msg = array(
              'status' => "_success",
              'msg'    => "Thêm mới thành công",
            );
            return response()->json($msg);
        }
        else
        {
             $msg = array(
              'status' => "_error",
              'msg'    => "Có lỗi xảy ra. Vui lòng thử lại",
            );
            return response()->json($msg);
        }
        //return redirect('/user/permissions')->with('flash_message_success','Thêm thành công !');
    }
    public function edit($id){
        if (! Gate::allows('edit_user')) {
            return view('errors.401');
        }
        $permission_detail = Permission::find($id);
        return view('permissions.edit', compact('permission_detail'));
    }
    public function postedit(Request $req){
        $permission_detail = Permission::find($req->id);
        $permission_detail->name = $req->name;
        $permission_detail->save();
        return redirect('/user/permissions')->with('flash_message_success','Sửa thành công !');
    }
    public function delete(Request $req){

        if (Permission::destroy($req->id)) {
			$msg = array(
				'status' => '_success',
				'msg'    => 'Xóa thành công',
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
