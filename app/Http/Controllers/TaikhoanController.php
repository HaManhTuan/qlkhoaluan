<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaikhoanController extends Controller
{
    public function getTaikhoan(){
    	return view('qltaikhoan.taikhoan');
    }

}
