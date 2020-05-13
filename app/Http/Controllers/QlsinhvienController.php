<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Students;
class QlsinhvienController extends Controller
{
    public function getQlsinhvien(Request $request){
      // if(request()->ajax())
      //  {
      //   if(!empty($request->filter_gender))
      //   {
      //    $data = Students::with('branches')
      //      ->select('msv', 'name', 'id_branch', 'id_classes')
      //      ->where('id_branch', $request->filter_gender)
      //      ->where('id_classes', $request->filter_country)
      //      ->get();
      //   }
      //   else
      //   {
      //    $data = Students::with('branches')
      //      ->select('msv', 'name', 'id_branch', 'id_classes')
      //      ->get();
      //   }
      //   return datatables()->of($data)->make(true);
      // }
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
}
