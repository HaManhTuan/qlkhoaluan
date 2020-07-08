<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProtectLecturer;
use App\Model\StudentCouncil;
use App\Model\Protections;
use App\Model\Lecturers;
use App\Model\CouncilProtect;
use Illuminate\Support\Str;
use App\Exports\StudentCouncilExport;
use App\Exports\DetailCouncilExport;
use App\Imports\StudentCouncilImport;
use Maatwebsite\Excel\Facades\Excel;
class ProtectLecturerController extends Controller
{
  public function add()
  {
    $protect = Protections::all();
    $lecturer = Lecturers::all();
    return view('qlhoidong.add')->with('protect',$protect)->with('lecturer',$lecturer);
  }
  public function addPost(Request $req)
    {
     
      $data = $req->all();
      foreach ($data['id_lecturer'] as $key => $val) {
        $pro             = new ProtectLecturer();
        $pro->id_lecture     = $val;
        $pro->name_council   = $data['name'];
        $slug = Str::slug($data['name'], '-');
        $pro->id_council     = $data['id_protect']."-".$slug;
        $pro->id_protect     = $data['id_protect'];
        $pro->position       = $data['postion'][$key];
        $query               = $pro->save();
      }
      $id_council = ProtectLecturer::orderBy('id','DESC')->value('id_council');
      $id_protect = ProtectLecturer::orderBy('id','DESC')->value('id_protect');
      $CouncilProtect = new CouncilProtect();
      $CouncilProtect->id_council = $id_council;
      $CouncilProtect->id_protect = $id_protect;
      $CouncilProtect->save();
      $path = $req->file('select_file')->getRealPath();
      Excel::import(new StudentCouncilImport, $path);

      StudentCouncil::where('council',$data['name'])->update([
           'council' => $req->name,
           'id_council' => $data['id_protect']."-".$slug
        ]);
      
      if ($query) {
        return redirect('qlhoidong')->with('flash_message_success','Bạn đã thêm thành công hội đồng');
      } else {
        return redirect('qlhoidong')->with('flash_message_success','Có lỗi xảy ra vui lòng thử lại');
      }
    }
    public function export()
    {

      return Excel::download(new StudentCouncilExport, 'danh-sach-sv-dk.xlsx');
      
    }
    public function exportPro($id)
    {
      $StudentCouncil = StudentCouncil::where('id_council',$id)->value('council');
      return Excel::download(new DetailCouncilExport($id), 'Hoi-dong-'.$StudentCouncil.'.xlsx');
    }
}
