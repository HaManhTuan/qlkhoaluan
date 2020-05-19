<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Branches;
use App\Model\Classes;
use App\Model\Fields;
use App\Model\Lecturers;
use App\Model\Topics;
use App\Model\TopicProtection;
use App\Imports\LecturersImport;
use App\Imports\TopicsImport;

use Excel;
class QlgiangvienController extends Controller
{
  public function getDataFieldSelect( $current_id = '') {
    $category_data = Fields::orderBy('created_at', 'asc')->get();
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
    public function getQlgiangvien(){
      $lecturers = Lecturers::with('department')->with('field')->with('topics')->get();
      $data_send = ['lecturers' => $lecturers];
    	return view('qlgiangvien.danhsachgv')->with($data_send);
    }
    public function detaillectures($id)
    {
     $lecturers = Lecturers::with('department')->with('field')->find($id);
     $topics = Topics::where('lecturers_id',$id)->get();
     $data_send = ['lecturers' => $lecturers,'topics' => $topics];
     return view('qlgiangvien.chitietgv')->with($data_send);
    }
    public function changestatus(Request $req){
      $lecturers = Lecturers::where('id',$req->id)->first();
      if ($lecturers->status == 0) {
          $lecturers->status = '1';
      }
      else
      {
        if ($lecturers->status == 1) {
          $lecturers->status = '0';
        }
      }
      if ($lecturers->save()) {
        $lecturersAfter = Lecturers::where('id',$req->id)->first();
        $msg = array(
        'status' => "_success",
        'msg'    => "Bạn đã cập nhật thành công.",
        'action'    => $lecturersAfter->status,
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

      //print_r($req->all());
    }
    public function getDanhsachsvdk(){
      $TopicProtection = TopicProtection::with('topics')->with('students')->orderBy('created_at','DESC')->get();
    	return view('qlgiangvien.danhsachsvdk')->with('TopicProtection',$TopicProtection);
    }



    public function getDetaigv(){
      $topics = Topics::orderBy('created_at','DESC')->get();
    	return view('qlgiangvien.detaigv')->with('topics',$topics);
    }
    public function changeaccept(Request $req)
    {
      $id         = $req->id;
      $length     = $req->length;
      $status     = $req->status;
      $id_array   = explode(",", $id);
      if (Topics::whereIn('id', $id_array)->update(['accept' => $status])) {
        $msg = [
        'status' => '_success',
        'msg'    => $length.' mục đã được thay đổi.'
        ];
        return response()->json($msg);
      }
      else {
        $msg = [
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.'
      ];
      return response()->json($msg);
      }
    }
    public function deletetopic(Request $req)
    {
      $id         = $req->id;
      $length     = $req->length;
      $status     = $req->status;
      $id_array   = explode(",", $id);
      if (Topics::whereIn('id', $id_array)->delete()) {
        $msg = [
        'status' => '_success',
        'msg'    => $length.' mục đã được xóa.'
        ];
        return response()->json($msg);
      }
      else {
        $msg = [
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.'
      ];
      return response()->json($msg);
    }
  }
  public function changedtstatus(Request $req)
  {
    $id         = $req->id;
      $length     = $req->length;
      $status     = $req->status;
      $id_array   = explode(",", $id);
      if (Topics::whereIn('id', $id_array)->update(['accept' => $status])) {
        $msg = [
        'status' => '_success',
        'msg'    => $length.' mục đã được thay đổi.'
        ];
        return response()->json($msg);
      }
      else {
        $msg = [
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.'
      ];
      return response()->json($msg);
      }
  }
    public function changeacceptancedt(Request $req)
  {
    $id         = $req->id;
      $length     = $req->length;
      $status     = $req->status;
      $id_array   = explode(",", $id);
      if (TopicProtection::whereIn('id', $id_array)->update(['acceptance' => $status])) {
        $msg = [
        'status' => '_success',
        'msg'    => $length.' mục đã được thay đổi.'
        ];
        return response()->json($msg);
      }
      else {
        $msg = [
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.'
      ];
      return response()->json($msg);
      }
  }
  public function import(Request $request)
  {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);
     $path = $request->file('select_file')->getRealPath();
     Excel::import(new LecturersImport, $path);
     return back()->with('success', 'Bạn đã import thành công.');
  }
  public function importnganhang(Request $request)
  {
    $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);
     $path = $request->file('select_file')->getRealPath();
     Excel::import(new TopicsImport, $path);
     return back()->with('success', 'Bạn đã import thành công.');
  }
  public function detaildtgv($id)
  {
    $detailTopic = Topics::with('branches')->find($id);
    $data_fields_select   = $this->getDataFieldSelect($detailTopic->fields_id);
    $data_send = ['detailTopic' =>$detailTopic,'data_fields_select' => $data_fields_select];
    return view('qlgiangvien.detaitopic')->with($data_send);
  }
}
