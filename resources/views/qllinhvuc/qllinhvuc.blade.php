@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Lĩnh Vực</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("ql-khoa")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh Sách Lĩnh Vực</li>
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
                         data-target="#create-depart"><i class="fa fa-plus-circle"></i> Thêm 
                 </button>
            </div>
          </div>
        </div>
        <div class="card-body p-5">
          <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center">Mã Lĩnh Vực</th>
                    <th class="text-center">Tên Lĩnh Vực</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody class="">
                  @foreach ($fields as $element)
                   <tr>
                     <td>{{$element->id}}</td>
                     <td>{{$element->name}}</td>
                     <td>
                       <button class="btn btn-success btn-edit-depart" data-id="{{ $element->id}}"><i class="fas fa-pencil-alt"></i></button>
                       <button class="btn btn-danger btn-del-depart" data-id="{{ $element->id}}"><i class="fas fa-trash"></i></button>
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
      <div class="modal fade" id="create-depart">
        <div class="modal-dialog bounceInRight animated">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm mới lĩnh vực</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ url('postqllinhvuc') }}" method="POST" id="frm-add" onsubmit="return false;">
               @csrf
                <div class="form-group">
                    <label for="fields">Tên lĩnh vực</label>
                    <input type="text" class="form-control" id="fields" name="fields" placeholder="Hãy nhập tên lĩnh vực" data-rule-required="true" data-msg-required="Vui lòng nhập tên lĩnh vực.">
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
  {{-- Modal-edit --}}
      <div class="modal fade" id="update-depart">
        <div class="modal-dialog bounceInRight animated">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Chỉnh sửa lĩnh vực</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             <form action="{{ url('postupdateqllinhvuc') }}" method="POST" id="frm-update" onsubmit="return false;">
               @csrf
            <div class="modal-body">
            
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary btn-update">Sửa</button>
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
              $("#create-depart").modal('hide');
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
    $(".btn-edit-depart").click(function() {
      let id = $(this).attr('data-id');
      $.ajax({
        url: '{{url("post-modal-field")}}',
        type: 'POST',
        data: {id: id},
        dataType: 'JSON',
        headers: {
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        success:function(data) {
          $("#update-depart .modal-body").html(data.body);
          $("#update-depart").modal('show');
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
    //EditAction
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
              $("#update-depart").modal('hide');
              $('#frm-update')[0].reset();
              if(data.status == '_success') {
                  Toast.fire({
                      icon: 'success',
                      title:  data.msg,
                  }).then(() => {
                  location.reload();
                });
              } else {
                Toast.fire({
                  icon: 'error',
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
    //Deletel
    $(".btn-del-depart").on('click',function() {
      let id = $(this).attr('data-id');
      Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp xóa 1 Lĩnh Vực.</p><p>Bạn có chắn chắn muốn xóa?</p>',
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
            url: '{{ url('delete-fields') }}',
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
