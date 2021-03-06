<?php

namespace App\Http\Controllers\Lecturers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Topics;
use App\Model\Fields;
use Auth;
class TopicController extends Controller
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
  public function view()
  {
    $data_fields_select   = $this->getDataFieldSelect();
    $dataTopic = Topics::where('lecturers_id',Auth::guard('lecturers')->user()->id)->orderBy('accept','DESC')->get();
    return view('lecturers.topic.list')->with('dataTopic',$dataTopic)->with('data_fields_select', $data_fields_select);
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
      $topics->fields_id = $req->field;
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
     $data_fields_select   = $this->getDataFieldSelect($detailTopic->fields_id);
    $data         = '<div class="form-group">
                    <label for="department">Lĩnh Vực</label>
                    <select name="field" class="form-control">
                      <option value="" selected="" disabled="">---Chọn---</option>
                      '.$data_fields_select.'
                    </select>
                </div><div class="form-group">
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
    $topics->fields_id = $req->field;
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
