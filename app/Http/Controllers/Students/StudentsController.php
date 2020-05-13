<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginStusPost;
use Auth;
use App\Model\Fields;
use App\Model\Topics;
use App\Model\TopicProtection;
class StudentsController extends Controller
{
  public function getDataFieldSelect( $current_id = '') {
   
    $category_data = Fields::orderBy('created_at', 'asc')->get();
    $data_select   = "";

    foreach ($category_data as $category_item) {

        if ($current_id != "") {
          if ($category_item['id'] == $current_id) {
            $selected = "selected='selected'";
          } else {
            $selected = "";
          }
        } else {
          $selected = "";
        }
        $data_select .= '<option value="'.$category_item['id'].'" '.$selected.'>';
        $data_select .= $category_item['name'];
        $data_select .= '</option>';
     
    }
    return $data_select;
  }
  public function login()
  {
    return view('students.auth.login');
  }
  public function dangnhap(StoreLoginStusPost $req)
  {
    $validated = $req->validated();
    $data = $req->all();
    if (Auth::guard('students')->attempt(['msv' =>$data['msv'], 'password' => $data['password'], 'status' => '1'])) {
      return redirect('students/dashboard');  
    }
    else {
      return redirect('students/login')->with('flash_message_error','Tài khoản hoặc mật khẩu  sai');    
    }
  }
  public function registerTopics()
  {
    $TopicProtection = TopicProtection::with('topics')->where('id_student',Auth::guard('students')->user()->id)->first();
    // echo "<pre>";
    // print_r($TopicProtection);
    // echo "</pre>";
    // die();
    $data_field_select   = $this->getDataFieldSelect();
    return view('students.registerTopic')->with('data_field_select',$data_field_select)->with('TopicProtection',$TopicProtection);
  }
  public function changeregisterfields(Request $req)
  {
    $TopicProtection = TopicProtection::orderBy('created_at','DESC')->select('id')->get()->toArray();
    $topics = Topics::where('accept',1)->whereNotIn('id',$TopicProtection)->get();
    return json_encode($topics);
  }
  public function registerpostTopics(Request $req){
    $TopicProtection = new TopicProtection();
    $TopicProtection->id_student = Auth::guard('students')->user()->id;
    $TopicProtection->id_topic = $req->topics_id;
     if ($TopicProtection->save()) {
      return redirect('students/register-topic')->with('flash_message_success','Bạn đã đăng kí thành công.');
     }
     else{
      return redirect('students/register-topic')->with('flash_message_error','Có lỗi xảy ra vui lòng thử lại');  
     }
  }
}
