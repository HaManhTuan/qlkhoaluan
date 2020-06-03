<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Topics;
use App\Model\Fields;
use App\Model\Students;
use App\Model\Lecturers;
use App\Model\Protections;
use App\Model\TopicProtection;
use App\Model\StudentCouncil;
class PageController extends Controller
{
    public function getIndex(){
      $count_topic = Topics::where('accept',1)->count();
      $count_topic_pro = TopicProtection::count();
      $count_lecturers = Lecturers::count();
      $count_protections = Protections::count();
      $data_protections = Protections::orderBy('created_at','DESC')->get();
      $data_fields = Fields::orderBy('id','ASC')->get();
      $fields = [];
      foreach ($data_fields as $item) {
        if (in_array($item->name, $fields) == false) {
            $fields[] = $item->name;
        }
      }
      $idin = [];
      foreach ($data_protections as $item) {
        if (in_array($item->name, $idin) == false) {
            $idin[] = $item->name;
        }
      }
      $StudentCouncilfail = StudentCouncil::where('score','<','4')->count();
      $StudentCouncilpass = StudentCouncil::where('score','>','4')->count();
      // $nameTopicProtection = TopicProtection::with('fields')->orderBy('fields_id','DESC')->get();
      $nameTopicProtection=TopicProtection::orderBy('fields_id','ASC')->join('fields', 'fields.id', '=', 'topic_protection.fields_id')->get('name');
      $topicName = [];
      foreach ($nameTopicProtection as $item) {
        if (in_array(($item->name), $topicName) == false) {
            $topicName[] = ($item->name);
        }
      }
      $TopicProtectionData = TopicProtection::with('fields')->orderBy('fields_id','ASC')->selectRaw('fields_id, COUNT(*) as count')
       ->selectRaw("fields_id")->groupBy('fields_id')->get();
      $topic = [];
      foreach ($TopicProtectionData as $item) {
            $topic[] = ($item->count);
      }
      $IDtopic = [];
      foreach ($TopicProtectionData as $item) {
            $IDtopic[] = ($item->fields_id);
      }
      // echo "<pre>";
      //  // print_r(json_encode($IDtopic)).'<br>';
      //  // print_r(json_encode($fields)).'<br>';
      //  if(array_diff(($fields),($IDtopic)) == true ) {
      //   print_r("hello");
      //  }
      // echo "</pre>";
      // die;
      $fail = [];
        if (in_array($StudentCouncilfail, $fail) == false) {
            $fail[] = $StudentCouncilfail;
        }
      $pass = [];
        if (in_array($StudentCouncilpass, $pass) == false) {
            $pass[] = $StudentCouncilpass;
        }
      $data_send = [
        'count_topic' => $count_topic,
        'count_topic_pro' => $count_topic_pro,
        'count_lecturers' => $count_lecturers,
        'count_protections' => $count_protections,
        'idin' => $idin,
        'fail' => $fail,
        'pass' => $pass,
        'fields' => $fields,
        'topic' => $topic,
        'topicName' => $topicName,
      ];
    	return view('home.trangchu')->with($data_send);
    }
}
