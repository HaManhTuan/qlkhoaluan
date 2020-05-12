<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Branches;
use App\Model\Classes;
use App\Model\Fields;
class QllinhvucController extends Controller
{
  public function Qllv()
  {
    $fields = Fields::get();
    return view('qllinhvuc.qllinhvuc')->with('fields',$fields);
  }
  public function postmodalfield(Request $req)
  {
    $detailDepart = Fields::find($req->id);
    $data         = '<div class="form-group">
    <input type="hidden" name="id" value="'.$detailDepart->id.'" />
    <label for="fields" class="control-label">Tên Lĩnh Vực <font color="#a94442">(*)</font></label>
    <input type="text" class="form-control" id="fields" name="fields" value="'.$detailDepart->name.'" data-rule-required="true" data-msg-required="Vui lòng nhập lĩnh vực."/>
    </div>';
    $msg = array(
      'body'    => $data
    );

    return json_encode($msg);
  }
  public function postqllinhvuc(Request $req)
  {
    $fields = new Fields();
    $fields->name = $req->fields;
    if ($fields->save()) {
     $msg = array(
      'status' => "_success",
      'msg'    => "Bạn đã thêm mới 1 lĩnh vực.",
    );
    return response()->json($msg);
    }
    else {
     $msg = array(
      'status' => "_error",
      'msg'    => "Có lỗi xảy ra. Vui lòng thử lại.",
    );
    return response()->json($msg);
    }
  }
  public function postupdateqllinhvuc(Request $req)
  {
    $id                  = $req->id;
    $department          = Fields::where('id', $id)->first();
    $department->name = $req->fields;
   
    if ($department->save()) {
      $msg = array(
        'status' => '_success',
        'msg'    => 'Cập nhật thành công',
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
  public function deletefields(Request $req)
  {
    $id     = $req->id;
    $length = $req->length;
    if (Fields::destroy($id)) {
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
  public function getQlkhoa(){
    $department = Department::get();
  	return view('qllinhvuc.qlkhoa')->with('department', $department);
  }
  public function postQlkhoa(Request $req)
  {
    $department = new Department();
    $department->name = $req->department;
    if ($department->save()) {
     $msg = array(
      'status' => "_success",
      'msg'    => "Bạn đã thêm mới 1 khoa.",
    );
    return response()->json($msg);
    }
    else {
     $msg = array(
      'status' => "_error",
      'msg'    => "Có lỗi xảy ra. Vui lòng thử lại.",
    );
    return response()->json($msg);
    }
  }
  public function postmodalQlkhoa(Request $req)
  {
    $detailDepart = Department::find($req->id);
    $data         = '<div class="form-group">
    <input type="hidden" name="id" value="'.$detailDepart->id.'" />
    <label for="department_name" class="control-label">Mã code <font color="#a94442">(*)</font></label>
    <input type="text" class="form-control" id="department_name" name="department_name" value="'.$detailDepart->name.'" data-rule-required="true" data-msg-required="Vui lòng nhập Khoa."/>
    </div>';
    $msg = array(
      'body'    => $data
    );

    return json_encode($msg);
  }
  public function postupdateQlkhoa(Request $req)
  {
    $id                  = $req->id;
    $department              = Department::where('id', $id)->first();
    $department->name = $req->department_name;
   
    if ($department->save()) {
      $msg = array(
        'status' => '_success',
        'msg'    => 'Cập nhật thành công',
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
  public function deletedepart(Request $req)
  {
    $id     = $req->id;
    $length = $req->length;
    if (Department::destroy($id)) {
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
  public function getQlnganh(){
    $data_depart_select   = $this->getDataDepartmentSelect();
    $braches = Branches::with('department')->orderBy('created_at','ASC')->get();
    $data_send = ['data_depart_select' => $data_depart_select, 'braches' => $braches];
  	return view('qllinhvuc.qlnganh')->with($data_send);
  }
  public function postqlnganh(Request $req)
  {
    $branches = new Branches();
    $branches->name = $req->branches;
    $branches->department_id = $req->department_id;
    $name_depart = Department::where('id',$req->department_id)->value('name');
    if ($branches->save()) {
     $msg = array(
      'status' => "_success",
      'msg'    => "Bạn đã thêm mới 1 ngành trong ".$name_depart,
    );
    return response()->json($msg);
    }
    else {
     $msg = array(
      'status' => "_error",
      'msg'    => "Có lỗi xảy ra. Vui lòng thử lại.",
    );
    return response()->json($msg);
    }
  }

  public function postmodalQlnganh(Request $req)
  {
    $detailBranches = Branches::find($req->id);
    $data_select   = $this->getDataDepartmentSelect($req->id);
    $data = '
             <div class="form-group">
            
              <label class="control-label">Chọn Khoa <font color="#a94442">(*)</font></label>
              <select class="form-control custom-select" name="department_id_update" id="department_id_update" data-rule-required="true" data-msg-required="Vui lòng chọn Khoa.">
                  <option value="" disabled="disabled">--- Chọn Khoa ---</option>
                  '.$data_select.'
              </select>
          </div>';
    $data         .= '<div class="form-group">
    <input type="hidden" name="id" value="'.$detailBranches->id.'" />
    <label for="branches_name" class="control-label">Mã code <font color="#a94442">(*)</font></label>
    <input type="text" class="form-control" id="branches_name" name="department_name_update" value="'.$detailBranches->name.'" data-rule-required="true" data-msg-required="Vui lòng nhập Ngành."/>
    </div>';
    $msg = array(
      'body'    => $data
    );
    return json_encode($msg);
  }
  public function postupdateqlnganh(Request $req)
  {
    $id                = $req->id;
    $branches          = Branches::where('id', $id)->first();
    $branches->department_id = $req->department_id_update;
    $branches->name = $req->department_name_update;
   
    if ($branches->save()) {
      $msg = array(
        'status' => '_success',
        'msg'    => 'Cập nhật thành công',
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
  public function deletebranches(Request $req)
  {
    $id     = $req->id;
    $length = $req->length;
    if (Branches::destroy($id)) {
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
  public function getQllop(){
    $data_depart_select   = $this->getDataDepartmentSelect();
    $classes = Classes::with('department')->with('branches')->orderBy('created_at','ASC')->get();
    // echo "<pre>";
    // print_r($classes);
    // echo "</pre>";
    $data_send = ['data_depart_select' => $data_depart_select, 'classes' => $classes]; 
    return view('qllinhvuc.qllop')->with($data_send);
  }
  public function changeDepart(Request $req)
  {
    $dataBranches = Branches::where('department_id',$req->departmentid)->get();
    return json_encode($dataBranches);
  }
  public function postqllop(Request $req)
  {
    $classes = new Classes();
    $classes->name = $req->classes;
    $classes->department_id = $req->department_id;
    $classes->branch_id = $req->branches_id;
   
    if ($classes->save()) {
     $msg = array(
      'status' => "_success",
      'msg'    => "Bạn đã thêm mới 1 lớp ",
    );
    return response()->json($msg);
    }
    else {
     $msg = array(
      'status' => "_error",
      'msg'    => "Có lỗi xảy ra. Vui lòng thử lại.",
    );
    return response()->json($msg);
    }
  }
  public function loadFormEdit($id)
  {
   $classes= Classes::find($id);
    $data_depart_select   = $this->getDataDepartmentSelect($classes->department_id);
    $data_branches_select   = $this->getDataBranchesSelect($classes->department_id,$classes->branch_id);
   $data_send = ['classes' => $classes, 'data_depart_select' => $data_depart_select, 'data_branches_select' => $data_branches_select];
   return view('qllinhvuc.editlop')->with($data_send);
  }
  public function postupdateqllop(Request $req)
  {
     $classes = Classes::find($req->id);
     $classes->name = $req->classes;
     $classes->department_id = $req->department_id;
     $classes->branch_id = $req->branches_id; 
      if ($classes->save()) {
        return redirect('qllop')->with('flash_message_success','Bạn đã sửa lớp thành công');
      }
      else
      {
        return redirect('qllop')->with('flash_message_error',"Có lỗi xảy ra. Vui lòng thử lại.");
      }
  }
  public function deleteclasses(Request $req)
  {
      $id     = $req->id;
      $length = $req->length;
      if (Classes::destroy($id)) {
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
