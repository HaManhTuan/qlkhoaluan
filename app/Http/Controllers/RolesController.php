<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
    public function add(){
        if (! Gate::allows('add_user')) {
            return view('errors.401');
        }
        $permissions = Permission::get()->pluck('name', 'name');
        return view('roles.add', compact('permissions'));
    }
    public function postadd(Request $req){
        $role = Role::create($req->except('permission'));
        $permissions = $req->input('permission') ? $req->input('permission') : [];
        $role->givePermissionTo($permissions);
        return redirect('/user/roles')->with('flash_message_success','Thêm luật mới thành công !');
    }
    public function edit($id){
        if (! Gate::allows('edit_user')) {
            return view('errors.401');
        }
        $role = Role::find($id);
        $permissions = Permission::get()->pluck('name', 'name');
        return view('roles.edit', compact('role','permissions'));
    }
    public function postedit(Request $req, Role $role){
        $role = Role::find($req->id);
        $role->update($req->except('permission'));
        $permissions = $req->input('permission') ? $req->input('permission') : [];
        $role->syncPermissions($permissions);
        return redirect('/user/roles')->with('flash_message_success','Edit successfully !');
    }
    public function delete(Request $req){
        if (! Gate::allows('del_user')) {
            return view('errors.401');
        }
        if (Role::destroy($req->id)) {
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
