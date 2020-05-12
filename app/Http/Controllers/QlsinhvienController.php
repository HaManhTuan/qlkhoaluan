<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QlsinhvienController extends Controller
{
    public function getQlsinhvien(){
    	return view('qlsinhvien.danhsachsv');
    }
}
