<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Hash;
use App\Model\Students;
use App\Model\Department;
use App\Model\Branches;
use App\Model\Classes;
use App\Imports\StudentsImport;

class QlsinhvienController extends Controller
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
  public function getDataBranchesSelect($department_id='', $current_id = '') {
    $category_data = Branches::where('department_id',$department_id)->orderBy('created_at', 'asc')->get();
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
  public function getDataClassesSelect($branch_id='', $current_id = '') {
    $category_data = Classes::where('branch_id',$branch_id)->orderBy('created_at', 'asc')->get();
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

  public function getQlsinhvien(Request $request){
      $branches = Students::with('branches')
          ->select('id_branch')
          ->groupBy('id_branch')
          ->orderBy('id_branch', 'ASC')
          ->get();
      $classes = Students::with('classes')
          ->select('id_classes')
          ->groupBy('id_classes')
          ->orderBy('id_classes', 'ASC')
          ->get();
      $dataStudent = Students::with('branches')->with('classes')->orderBy('created_at')->get();
    	return view('qlsinhvien.danhsachsv')->with('branches', $branches)->with('classes', $classes)->with('dataStudent', $dataStudent);
    }
    public function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);
     $path = $request->file('select_file')->getRealPath();
     Excel::import(new StudentsImport, $path);
     return back()->with('success', 'Bạn đã import thành công.');
    }
    public function add()
    {
      $data_depart_select   = $this->getDataDepartmentSelect();
      $data_send = ['data_depart_select' => $data_depart_select];
      return view('qlsinhvien.add')->with($data_send);
    }
    public function changebrand(Request $req)
    {
      $dataBranches = Classes::where('branch_id',$req->branches_change)->get();
      return json_encode($dataBranches);
    }
    public function store(Request $req)
    {
     $check_msv = Students::where('msv',$req->msv)->count();
     if ($check_msv > 0) {
       return back()->with('flash_message_error', 'Mã sinh viên đã trùng.');
     }
     else{
      //print_r($req->all());
      $student = new Students();
      $student->msv = $req->msv;
      $student->name = $req->name;
      $student->password = Hash::make('123456');
      $student->id_department = $req->department_id;
      $student->id_classes = $req->branches_id;
      $student->id_branch = $req->classes;
      $student->status = 1;
      if ($student->save()) {
         return back()->with('flash_message_success', 'Bạn đã thêm thành công.');
      }

     }
    }
    public function edit($id)
    {
      $detail = Students::find($id);
      $data_depart_select   = $this->getDataDepartmentSelect();
      $data_send = ['data_depart_select' => $data_depart_select,'detail' => $detail];
     return view('qlsinhvien.edit')->with($data_send);
    }
    public function update(Request $req)
    {
      //print_r($req->all());
      $student =  Students::where('id',$req->id)->first();
      $student->name = $req->name;
      $student->id_department = $req->department_id;
      $student->id_classes = $req->branches_id;
      $student->id_branch = $req->classes;
      $student->status = 1;
      if ($student->save()) {
         return back()->with('flash_message_success', 'Bạn đã sửa thành công.');
      }
    }
    public function delete(Request $req)
    {
      $id     = $req->id;
    $length = $req->length;
    if (Students::destroy($id)) {
      $msg = array(
        'status' => '_success',
        'msg'    => $length.' mục đã được xóa',
      );
      return json_encode($msg);
    } else {
      $msg = array(
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại',
      );
      return json_encode($msg);
    }
    }
}
