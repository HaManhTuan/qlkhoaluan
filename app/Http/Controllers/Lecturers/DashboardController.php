<?php

namespace App\Http\Controllers\Lecturers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Lecturers;
use App\Model\Topics;
use App\Model\Students;
use App\Model\TopicProtection;
use Auth;
class DashboardController extends Controller
{
  public function index()
  {
    $topics = Topics::where('lecturers_id',Auth::guard('lecturers')->user()->id)->get();
    $topics_accept = Topics::where(['lecturers_id' => Auth::guard('lecturers')->user()->id,'accept' => 1])->get();
    $topics_accept_id = Topics::where(['lecturers_id' => Auth::guard('lecturers')->user()->id,'accept' => 1])->select('id')->get()->toArray();
    $TopicProtection = TopicProtection::with('topics')->with('students')->whereIn('id_topic',$topics_accept_id)->get();
    //  echo "<pre>";
    // print_r($TopicProtection);
    // echo "</pre>";
    // die;
    $data_send = [
      'topics' => $topics,
      'topics_accept' => $topics_accept,
      'TopicProtection' => $TopicProtection
    ];
    return view('lecturers.dashboard')->with($data_send);
  }
}
