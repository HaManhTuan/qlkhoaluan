<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProtectLecturer;
use App\Model\Protections;
use App\Model\CouncilProtect;
use App\Model\StudentCouncil;

class QlhoidongController extends Controller
{
    public function getQlhoidong(){
      $ProtectLecturer = ProtectLecturer::orderBy('created_at','DESC')->get();
      $Protections = Protections::orderBy('created_at','DESC')->get();
    	return view('qlhoidong.danhsachhd')->with('Protections',$Protections)->with('ProtectLecturer',$ProtectLecturer);
    }
    public function chaneProtect(Request $req)
    {
      $CouncilProtect = CouncilProtect::where('id_protect',$req->id_protect)->get();
      $data =' <label for="name" class="form-label">Danh sách hội động</label><br>';
      foreach ($CouncilProtect as $key => $value) {
        $ProtectLecturer = ProtectLecturer::where('id_council',$value['id_council'])->first();
        $data .='<a href="'.url('council/detail').'/'.''.$value->id_council.'" class="btn btn-success ml-1" >Hội đồng '.$ProtectLecturer->name_council.'</a>';
      }
      return json_encode($data);
    }
    public function detail($id_council)
    {
      $name_council = ProtectLecturer::with('protect')->where('id_council',$id_council)->first();
      $lecturer = ProtectLecturer::with('lecturer')->where('id_council',$id_council)->get();
      $StudentCouncil = StudentCouncil::where('id_council',$id_council)->get();
      $data_send = ['name_council' => $name_council,'lecturer' => $lecturer,'StudentCouncil' => $StudentCouncil,'id_council' => $id_council];
      return view('qlhoidong.council')->with($data_send);
    }
    public function delete(Request $req)
    {
      StudentCouncil::where('id_council',$req->id_council)->delete();
      CouncilProtect::where('id_council',$req->id_council)->delete();
      ProtectLecturer::where('id_council',$req->id_council)->delete();
      $msg = array(
        'status' => "_success",
        'msg'    => "Bạn đã xoá 1 Hội đồng.",
      );
      return response()->json($msg);
    }
}
