@extends('layout')
@section('content')
@if(Session::has('flash_message_error'))
<script>
$(document).ready(function() {
 const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
   Toast.fire({
      icon: 'error',
      title: "{{ Session::get('flash_message_error') }}"
  });
});
</script>
 @endif
 @if(Session::has('flash_message_success'))
<script>
$(document).ready(function() {
 const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
   Toast.fire({
       icon: 'success',
      title: "{{ Session::get('flash_message_success') }}"
  });
});
</script>
 @endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Lớp</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("ql-lop")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh Sách Lớp</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <div class="btn-groups">
                 <button type="button" class="btn btn-primary" data-toggle="modal"
                         data-target="#create-classes"><i class="fa fa-plus-circle"></i> Thêm Lớp
                 </button>
                
            </div>
          </div>

        </div>

        <div class="card-body p-0">
          <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Mã Lớp</th>
                            <th class="text-center">Mã Khoa</th>
                            <th class="text-center">Mã Ngành</th>
                            <th class="text-center">Tên Lớp</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody class="ajax-loadlist-customer">
                          @foreach ($classes as $element)
                             <tr>
                                <td>{{$element->id}}</td>
                                <td>{{$element->department->name}}</td>
                                <td>{{$element->branches->name}}</td>
                                <td>{{$element->name}}</td>
                                <td>
                                  <button class="btn btn-success btn-edit-classes" onclick="window.location.href='{{url('edit-classes/'.$element->id)}}'"><i class="fas fa-pencil-alt"></i></button>
                                   <button class="btn btn-danger btn-del-classes" data-id="{{ $element->id}}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>

                    </table>
            </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  {{-- Modal-add --}}
      <div class="modal fade" id="create-classes">
        <div class="modal-dialog bounceInRight animated">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm mới lớp</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ url('postqllop') }}" method="POST" id="frm-add" onsubmit="return false;">
               @csrf
                <div class="form-group">
                    <label for="department">Tên Khoa</label>
                    <select name="department_id" class="form-control" id="department">
                       <option value="" disabled="disabled" selected="selected">--- Chọn Khoa ---</option>
                      {!!$data_depart_select!!}
                    </select>
                  
                </div>
                <div class="form-group">
                    <label for="branches_id">Tên Ngành</label>
                    <select name="branches_id" class="form-control" id="braches">
                        <option value="" disabled="disabled" selected="selected">--- Chọn Ngành ---</option>
                    </select>
                  
                </div>
                <div class="form-group">
                    <label for="department">Tên Lớp</label>
                    <input type="text" class="form-control" id="classes" name="classes" placeholder="Hãy nhập tên lớp" data-rule-required="true" data-msg-required="Vui lòng nhập tên lớp.">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary btn-save">Lưu</button>
            </div>
          </div>
           </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script>
     const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
// Change
  $("#department").change(function() {
      let department_change = $(this).val();
      if ($.trim(department_change) != '') {
          $.ajax({
              url: '{{ url('changeDepart')}}',
              type: 'POST',
              data: {departmentid: department_change},
              dataType: 'JSON',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(branches_data) {
                console.log(branches_data);
                  let branches_html = "";
                  $.each(branches_data, function(index, value) {
                      branches_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                  });
                  $("#braches").html(branches_html);
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
  });
  $(".btn-save").click(function() {
    $("#frm-add").validate({
      submitHandler: function() {
        let action = $("#frm-add").attr('action');
        let method = $("#frm-add").attr('method');
        let formData = $("#frm-add").serialize();
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
            $("#create-classes").modal('hide');
            $('#frm-add')[0].reset();
            if(data.status == '_success') {
              Toast.fire({
                    icon: 'success',
                    title: data.msg
                }).then(() => {
                location.reload();
              });
            } else {
                Toast.fire({
                       icon: 'error',
                      title: data.msg
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
      //Deletel
  $(".btn-del-classes").on('click',function() {
    let id = $(this).attr('data-id');
    Swal({
      title: 'Xác nhận xóa?',
      type: 'error',
      html: '<p>Bạn sắp xóa 1 Lớp.</p><p>Bạn có chắn chắn muốn xóa?</p>',
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
          url: '{{ url('delete-classes') }}',
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
