<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QlgiangvienController extends Controller
{
    public function getQlgiangvien(){
    	return view('qlgiangvien.danhsachgv');
    }

    public function getDanhsachsvdk(){
    	return view('qlgiangvien.danhsachsvdk');
    }
    public function getDetaigv(){
    	return view('qlgiangvien.detaigv');
    }
}
