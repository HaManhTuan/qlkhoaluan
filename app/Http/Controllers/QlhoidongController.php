<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QlhoidongController extends Controller
{
    public function getQlhoidong(){
    	return view('qlhoidong.danhsachhd');
    }
}
