<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QlkhoaluanController extends Controller
{
    public function getQlkhoaluan(){
    	return view('qlkhoaluan.danhsachdt');
    }

    public function getDangkidt(){
    	return view('qlkhoaluan.dangkidt');
    }
}
