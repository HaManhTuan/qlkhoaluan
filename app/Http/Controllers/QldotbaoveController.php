<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QldotbaoveController extends Controller
{
    public function getQldotbaove(){
    	return view('qldotbaove.danhsachdbv');
    }
}
