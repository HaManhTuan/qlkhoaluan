<?php

namespace App\Http\Controllers\Lecturers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Topics;
use Auth;
class TopicController extends Controller
{
  public function view()
  {
    $dataTopic = Topics::where('lecturers_id',Auth::guard('lecturers')->user()->id)->orderBy('accept','DESC')->get();
    return view('lecturers.topic.list')->with('dataTopic',$dataTopic);
  }
  public function add(Request $req)
  {
    $checkTopics = Topics::where('name','LIKE','%'.$req->name.'%')->get();
    if ($checkTopics->count() > 0) {
       $msg = array(
          'status' => '_error',
          'msg'    => 'Tên Để Tài này đã tồn tại');
        return json_encode($msg);
    }
    else{
      $topics = new Topics();
      $topics->name = $req->name;
      $topics->description = $req->description;
      $topics->lecturers_id = Auth::guard('lecturers')->user()->id;
      $topics->accept = '0';
      if ($topics->save()) {
        $msg = [
        'status' => '_success',
        'msg' => 'Bạn đã thêm mới một đề tài. Hãy đợi người kiểm duyệt.'
        ];
        return response()->json($msg);
      }
      else
      {
        $msg = array(
          'status' => '_error',
          'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại',
        );
        return json_encode($msg);
      }
    }

  }
  public function editModal(Request $req)
  {
    $detailTopic = Topics::find($req->id);
    $data         = '<div class="form-group">
    <input type="hidden" name="id" value="'.$detailTopic->id.'" />
    <label for="fields" class="control-label">Tên Đề Tài <font color="#a94442">(*)</font></label>
    <textarea name="name" class="form-control" rows="4" data-rule-required="true" data-msg-required="Vui lòng nhập tên để tài.">'.$detailTopic->name.'</textarea>
    </div>
    <div class="form-group">
    <label for="fields" class="control-label">Mô tả  Đề Tài <font color="#a94442">(*)</font></label>
    <textarea name="description" class="form-control" rows="4" data-rule-required="true" data-msg-required="Vui lòng nhập tên để tài.">'.$detailTopic->description.'</textarea>
    </div>';
    $msg = array(
      'body'    => $data
    );

    return json_encode($msg);
  }
  public function edit(Request $req)
  {
    $topics =  Topics::find($req->id);
    $topics->name = $req->name;
    $topics->description = $req->description;
    $topics->accept = '0';
    if ($topics->save()) {
     $msg = array(
      'status' => "_success",
      'msg'    => "Bạn đã sửa để tài.",
    );
    return response()->json($msg);
    }
    else {
     $msg = array(
      'status' => "_error",
      'msg'    => "Có lỗi xảy ra. Vui lòng thử lại.",
    );
    return response()->json($msg);
    }
  }
  public function delete(Request $req)
  {
    $id     = $req->id;
    $length = $req->length;
    if (Topics::destroy($id)) {
      $msg = array(
        'status' => '_success',
        'msg'    => $length.' mục đã được xóa',
      );
      return json_encode($msg);
    } else {
      $msg = array(
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại',
      );
      return json_encode($msg);
    }
  }
}
