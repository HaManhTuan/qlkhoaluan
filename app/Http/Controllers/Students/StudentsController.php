<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginStusPost;
use Auth;
use App\Model\Fields;
use App\Model\Topics;
use App\Model\TopicProtection;
use App\Model\Protections;
use App\Model\Students;
use Hash;
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
    if (isset($TopicProtection->id_topic) && $TopicProtection->id_topic != "") {
      $Topics = Topics::with('branches')->where('id',$TopicProtection->id_topic)->first();
    }
    else {
      $Topics ="";
    }
    
    if (isset($TopicProtection->id_protection) && $TopicProtection->id_protection != "") {
     $Protections = Protections::where('id',$TopicProtection->id_protection)->first();
    }
    else{
      $Protections ="";
    }
    $data_field_select   = $this->getDataFieldSelect();
    $protectionsdata   = Protections::where('accept',1)->where('time_end', '>=', date("Y-m-d"))->orderBy('created_at','DESC')->get();
    return view('students.registerTopic')->with('data_field_select',$data_field_select)->with('TopicProtection',$TopicProtection)->with('Topics',$Topics)->with('Protections',$Protections)->with('protectionsdata',$protectionsdata);
  }
  public function changeregisterfields(Request $req)
  {
    $TopicProtection = TopicProtection::orderBy('created_at','DESC')->select('id_topic')->get()->toArray();
    $topics = Topics::where('accept',1)->where('fields_id',$req->field_id)->whereNotIn('id',$TopicProtection)->get();
    return json_encode($topics);
    
    
   
  }
  public function registerpostTopics(Request $req){
    $TopicProtection = new TopicProtection();
    $TopicProtection->id_student = Auth::guard('students')->user()->id;
    $TopicProtection->id_topic = $req->topics_id;
    $TopicProtection->id_protection = $req->id_protection;
     if ($TopicProtection->save()) {
      return redirect('students/register-topic')->with('flash_message_success','Bạn đã đăng kí thành công.');
     }
     else{
      return redirect('students/register-topic')->with('flash_message_error','Có lỗi xảy ra vui lòng thử lại');  
     }
  }
  public function changepass(Request $req)
  {
        $pwd        = $req->retypeNewPwd;
        $pwd_bcrypt = Hash::make($pwd);
        $id         = $req->id;
        $query      = Students::where("id", $id)->update(['password' => $pwd_bcrypt]);
        if (!$query || $query == false) {
            $msg = [
                'status' => '_error',
                'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại'
            ];
            return response()->json($msg);
        } else {
            Auth::guard('students')->logout();
            $msg = [
                'status' => '_success',
                'msg'    => 'Mật khẩu đã được thay đổi thành công'
            ];
            return response()->json($msg);
        }
  }
}
