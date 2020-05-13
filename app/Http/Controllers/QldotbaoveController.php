<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Protections;
class QldotbaoveController extends Controller
{
    public function getQldotbaove(){
      $Protections = Protections::orderBy('created_at','DESC')->get();
    	return view('qldotbaove.danhsachdbv')->with('Protections', $Protections);
    }
    public function add()
    {
      return view('qldotbaove.add');
    }
    public function addpost(Request $req)
    {
      $Protections = new Protections();
      $Protections->name = $req->name;
      $Protections->time_start = (($req->start_time));
      $Protections->time_end = (($req->end_time));
      if ($Protections->save()) {
        return redirect('danhsachdbv')->with('','Bạn đã thêm mới một đợt bảo vệ');
      }
      else{
          return redirect('danhsachdbv')->with('','Có lỗi xảy ra. Vui lòng thử lại');
      }
    }
    public function changestatushd(Request $req)
    {
      $lecturers = Protections::where('id',$req->id)->first();
      if ($lecturers->accept == 0) {
          $lecturers->accept = '1';
      }
      else
      {
        if ($lecturers->accept == 1) {
          $lecturers->accept = '0';
        }
      }
      if ($lecturers->save()) {
        $lecturersAfter = Protections::where('id',$req->id)->first();
        $msg = array(
        'status' => "_success",
        'msg'    => "Bạn đã cập nhật thành công.",
        'action'    => $lecturersAfter->accept,
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
    }
}
