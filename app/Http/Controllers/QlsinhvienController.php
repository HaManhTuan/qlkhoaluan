<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Hash;
use App\Model\Students;
use App\Imports\StudentsImport;
class QlsinhvienController extends Controller
{ 

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
}
