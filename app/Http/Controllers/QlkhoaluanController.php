<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TopicProtection;
use App\Model\Lecturers;
use App\Model\Topics;
use App\Model\Students;
use App\Model\Protections;
class QlkhoaluanController extends Controller
{
    public function getQlkhoaluan(){
      $TopicProtection = TopicProtection::with('topics')->with('students')->orderBy('created_at','DESC')->get();
    	return view('qlkhoaluan.danhsachdt')->with('TopicProtection',$TopicProtection);
    }
    public function detailkl($id)
    {
      $TopicProtection = TopicProtection::with('topics')->with('students')->with('protections')->where('id',$id)->first();
      $Students = Students::with('department')->with('branches')->with('classes')->where('id',$TopicProtection->id_student)->first();
      $topic = Topics::where('id',$TopicProtection->id_topic)->first();
      $Protections = Protections::where('id',$TopicProtection->id_protection)->first();
      $gvhd = Lecturers::with('department')->where('id',$topic->lecturers_id)->first();
      return view('qlkhoaluan.chitiet')->with('TopicProtection',$TopicProtection)->with('gvhd',$gvhd)->with('Students',$Students)->with('Protections',$Protections);
    }
    public function getDangkidt(){
    	return view('qlkhoaluan.dangkidt');
    }
    public function changedetailkl(Request $req)
    {
      $TopicProtection = TopicProtection::where('id',$req->id)->first();
      $TopicProtection->acceptance = $req->has('status')? '1':'0';
      if ($TopicProtection->save()) {
        return redirect('detail-kl/'.$req->id)->with('flash_message_success','Bạn đã thay đổi thành công. Giáo Viên và học sinh sẽ nhận được thông báo');
      }
      else{
        return redirect('detail-kl/'.$req->id)->with('flash_message_error','Có lỗi xảy ra. Vui lòng thử lại');
      }
     }
}
