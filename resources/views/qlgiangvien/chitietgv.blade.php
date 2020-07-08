@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Chi tiết GV - {{$lecturers->name_lecturer}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Chi tiết Giảng Viên</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card">
        <div class="card-body p-4" >
          <form action="" method="POST" >
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="department">Họ tên</label>
                    <input type="text" readonly class="form-control col-md-11" id="department" name="department" placeholder="Hãy nhập tên khoa" data-rule-required="true" data-msg-required="Vui lòng nhập tên Khoa." value="{{$lecturers->name_lecturer}}">
                </div>
                <div class="form-group">
                    <label for="department">Email</label>
                    <input type="text" readonly class="form-control col-md-11" id="department" name="department" placeholder="Hãy nhập tên khoa" data-rule-required="true" data-msg-required="Vui lòng nhập tên Khoa." value="{{$lecturers->email_address_lecturer}}">
                </div>
                <div class="form-group">
                    <label for="department">Địa chỉ</label>
                    <input type="text" readonly class="form-control col-md-11" id="department" name="department" placeholder="Hãy nhập tên khoa" data-rule-required="true" data-msg-required="Vui lòng nhập tên Khoa." value="{{$lecturers->address_lecturer}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="department">Số điện thoại</label>
                    <input type="text" readonly class="form-control col-md-11" id="department" name="department" placeholder="Hãy nhập tên khoa" data-rule-required="true" data-msg-required="Vui lòng nhập tên Khoa." value="{{$lecturers->phone_number}}">
                </div>
                <div class="form-group">
                    <label for="department">Khoa</label>
                    <input type="text" readonly class="form-control col-md-11" id="department" name="department" placeholder="Hãy nhập tên khoa" data-rule-required="true" data-msg-required="Vui lòng nhập tên Khoa." value="{{$lecturers->department->name}}">
                </div>
                <div class="form-group">
                    <label for="department">Lĩnh Vực</label>
                    <input type="text" readonly class="form-control col-md-11" id="department" name="department" placeholder="Hãy nhập tên khoa" data-rule-required="true" data-msg-required="Vui lòng nhập tên Khoa." value="{{$lecturers->field->name}}">
                </div>
              </div>
            </div>
           
          </form>
          </div>
      </div>
    </section>
</div>
<div class="content-wrapper" style="margin-top: -100px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Danh sách đề tài của Giáo Viên - {{$lecturers->name_lecturer}}</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
              <div class="row">
                <div class="col-md-6">
                  <select name="status" class="form-control" style="display: none;padding-top: 5px;" id="option-status" action="{{ url('change-accept') }}">
                       <option value="" selected="" disabled="">--Thay đổi trạng thái--</option>
                      <option value="1">Đã duyệt</option>
                    </select>
                  </div>
                <div class="col-md-6"> 
                  <button class="btn btn-danger" style="display: none;padding-top: 5px;" id="btn-del-all" data-action="{{ url('delete-topic') }}">
                    <i class="fas fa-trash-alt mr-2"></i>Xóa <span></span> mục đã chọn?
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="card-body p-4" >
          <table  class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="background-color: #fff;width: 50px;">
                              <input type="checkbox" id="checkall"/>
                            </th>
                            <th class="text-center">Tên để tài</th>
                            <th class="text-center" style="width: 100px">Trạng thái</th>
                            <th class="text-center" style="background-color: #fff;width: 250px;">Hành động</th>
                        </tr>
                        </thead>
                        <tbody class="ajax-loadlist-customer">
                          @foreach ($topics as $element)
                            <tr>
                              <td class="text-center"><input type="checkbox" class="checkbox" name="topics_id" value="{{$element->id}}"/></td>
                              <td>{{$element->name}}</td>
                              <td class="project-state text-center">
                                @if ($element->accept == 1)
                                  <span class="badge badge-success change_status" data-id="{{ $element->id }}">Đã Duyệt</span>
                                @else
                                  <span class="badge badge-danger change_status" data-id="{{ $element->id }}">Chờ Duyệt</span>
                                @endif
                              </td>
                              <td class="project-actions text-center">
<!--                                   <a class="btn btn-primary btn-sm" href="">
                                      <i class="fas fa-folder">
                                      </i>
                                      Xem
                                  </a> -->
                                  <a class="btn btn-info btn-sm btn-edit" href="#" data-toggle="modal" data-target="#edit-cust" class="btn-edit" data-id="{{$element->id}}" action="{{ url('editTopic') }}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Sửa
                                  </a>
                                  <a class="btn btn-danger btn-sm btn-del-topic" href="#" data-id="{{$element->id}}">
                                      <i class="fas fa-trash">
                                      </i>
                                      Xóa
                                  </a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
          </table>
        </div>
      </div>
    </section>
</div>
      <div class="modal fade" id="edit-cust">
        <div class="modal-dialog bounceInRight animated">
          <form action="{{ url('editTopicPost') }}" method="POST" id="frm-update" onsubmit="return false;">
               @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sửa đề tài</h4>
              <small></small> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary btn-update">Lưu</button>
            </div>
          </div>
           </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script type='text/javascript'>
$(document).ready(function(){
   // Check or Uncheck All checkboxes
  $("#checkall").change(function(){
     var checked = $(this).is(':checked');
     if(checked){

       $(".checkbox").each(function(){
         $(this).prop("checked",true);
       });
         $("#btn-del-all > span").html($(".checkbox:checked").length);
      $("#btn-del-all").fadeIn(300);
      $("#option-status").fadeIn(300);
     }else{
      $("#btn-del-all").hide();
       $("#option-status").hide();
       $(".checkbox").each(function(){
         $(this).prop("checked",false);
       });
     }
  });
 
  // Changing state of CheckAll checkbox 
  $(".checkbox").click(function(){

    if($(".checkbox").length == $(".checkbox:checked").length) {
      $("#checkall").prop("checked", true);
        
    } else {
      $("#checkall").removeAttr("checked");
    }
      if($(".checkbox:checked").length > 0){
         $("#btn-del-all > span").html($(".checkbox:checked").length);
        $("#btn-del-all").fadeIn(300);
          $("#option-status").fadeIn(300);
      } else {
        $("#btn-del-all").hide();
          $("#option-status").hide();
      }
  });
});
 //Xóa all
$(document).on('click', "#btn-del-all", function() {
    let action = $(this).data('action');
    let id_array = new Array();
    let chkCheckLength = $("input[type='checkbox']").filter(':checked').length;
    $("input[type='checkbox']").filter(':checked').each(function() {
        let id = $(this).val();
        id_array.push(id);
    });
    let idStr = id_array.join(',');
    //console.log(idStr);
    Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp xóa ' + chkCheckLength + ' đề tài. Điều này là không thể đảo ngược.</p><p>Bạn có chắn chắn muốn xóa?</p>',
        showConfirmButton: true,
        confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
        confirmButtonColor: '#ef5350',
        cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
        showCancelButton: true,
        focusConfirm: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                url: action,
                type: 'POST',
                data: { id: idStr, length: chkCheckLength },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function(data) {
                    //console.log(data);
                    if (data.status == '_success') {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'success',
                            timer: 2000
                        }).then(() => {
                            $("#btn-del-all").hide();
                            $("input[type='checkbox']").prop('checked', false);
                            $.each(id_array, function(index, value) {
                                $("#dd-item-" + value).remove();
                                //console.log(value);
                            });
                            if ($("#table-category .tr").length == 0) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            type: 'error'
                        });
                    }
                },
                error: function(err) {
                    console.log(err);
                    Swal({
                        title: 'Error ' + err.status,
                        text: err.responseText,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        type: 'error'
                    });
                }
            });
        }
        return false;
    });
    return false;
});
//Change-all
$(document).on('change', "#option-status", function() {
  let status = $(this).val();
    let action = $(this).attr('action');
    let id_array = new Array();
    let chkCheckLength = $("input[type='checkbox']").filter(':checked').length;
    $("input[type='checkbox']").filter(':checked').each(function() {
        let id = $(this).val();
        id_array.push(id);
    });
    let idStr = id_array.join(',');
    //console.log(idStr);
    Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp thay đổi ' + chkCheckLength + ' trạng thái đề tài thành đã duyệt.</p><p>Bạn có chắn chắn muốn thay đổi?</p>',
        showConfirmButton: true,
        confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
        confirmButtonColor: '#ef5350',
        cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
        showCancelButton: true,
        focusConfirm: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                url: action,
                type: 'POST',
                data: { id: idStr, length: chkCheckLength, status: status },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == '_success') {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'success',
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            type: 'error'
                        });
                    }
                },
                error: function(err) {
                    console.log(err);
                    Swal({
                        title: 'Error ' + err.status,
                        text: err.responseText,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        type: 'error'
                    });
                }
            });
        }
        return false;
    });
    return false;
});
$(document).on('click','.btn-edit',function() {
            let id = $(this).attr('data-id');
            let action = $(this).attr('action');
            $.ajax({
              url: action,
              type: 'POST',
              data: {id: id},
              dataType: 'JSON',
              headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
              },
              success:function(data) {
                $("#edit-cust .modal-body").html(data.body);
                $("#edit-cust").modal('show');
              },
              error: function(err) {
                console.log(err);
                Toast.fire({
                    icon: 'error',
                    title: "Error " + err.status,
                });
              }
            });
            return false;
});
$(".btn-update").click(function() {
      $("#frm-update").validate({
        submitHandler: function() {
          let action = $("#frm-update").attr('action');
          let method = $("#frm-update").attr('method');
          let formData = $("#frm-update").serialize();
          $.ajax({
            url: action,
            type: method,
            data: formData,
            dataType: 'JSON',
            headers: {
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            success: function(data) {
              console.log(data);
              $("#edit-cust").modal('hide');
              $('#frm-update')[0].reset();
              if(data.status == '_success') {
                  Swal({
                      title: data.msg,
                      showCancelButton: false,
                      showConfirmButton: false,
                      type: 'success',
                      timer: 2000
                  }).then(() => {
                      location.reload();
                  });
              } else {
                Toast.fire({
                  type: 'error',
                  title: data.msg,
                });
             }
           },
           error: function(err) {
            console.log(err);
          }
        });
        }
      });
});
$(".btn-del-topic").on('click',function() {
      let id = $(this).attr('data-id');
      Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp xóa 1 Đề Tài.</p><p>Bạn có chắn chắn muốn xóa?</p>',
        showConfirmButton: true,
        confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
        confirmButtonColor: '#ef5350',
        cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
        showCancelButton: true,
        focusConfirm: false,
        reverseButtons: true
      }).then((result) => {
        if (result.value == true) {
          $.ajax({
            url: "{{ url('delete-topic-post') }}",
            type: 'POST',
            data: {id: id, length: '1'},
            dataType: 'JSON',
            headers: {
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            success: function(data) {
                            //console.log(data);
                            if(data.status == '_success') {
                              Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
                              }).then(() => {
                                $("#tr-item-" +id).remove();
                                if ($(".coupon .tr-item").length == 0) {
                                  location.reload();
                                }
                              });
                            } else {
                              Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'error'
                              });
                            }
                          },
                          error: function(err) {
                            console.log(err);
                            Swal({
                              title: 'Error ' + err.status,
                              text: err.responseText,
                              showCancelButton: false,
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                              type: 'error'
                            });
                          }
                        });
        }
        return false;
      });
      return false;
});
</script>
@endsection
