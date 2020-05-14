<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\TopicProtection;
use App\Model\Lecturers;
use App\Model\Topics;
use App\Model\Students;
class DashboardController extends Controller
{
  public function index()
  {
    $id = Auth::guard('students')->user()->id;
    $Students = Students::with('department')->with('branches')->with('classes')->where('id',$id)->first();
    $TopicProtection = TopicProtection::with('topics')->with('students')->with('protections')->where('id_student',$id)->first();
    return view('students.dashboard')->with('TopicProtection', $TopicProtection)->with('Students',$Students);
  }
}
