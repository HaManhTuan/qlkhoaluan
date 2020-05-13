@extends('layouts.lecturers.lecturers')
@section('content')
<style type="text/css" media="screen">
  table tr td.btn-edit:hover{
    cursor: pointer;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Đề tài của bạn</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Quản Lý Đề tài của bạn</li>
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
                         data-target="#create-cust"><i class="fa fa-plus-circle"></i> Thêm Đề Tài
                 </button>
            </div>
          </div>
        </div>
        <div class="card-body p-4">
          <table  class="table table-bordered table-striped" id="tabletopic">
                        <thead>
                        <tr>
                          <th class="text-center">Action</th>
                            <th class="text-center">Tên đề tài</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Tình trạng</th>
                        </tr>
                        </thead>
                        <tbody class="ajax-loadlist-customer">
                          @foreach ($dataTopic as $element)
                           <tr >
                             <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    <div class="dropdown-menu" role="menu">
                                      <a class="dropdown-item" href="#">Xem chi tiết</a>
                                      <a class="dropdown-item btn-del-topic"  data-id="{{$element->id}}">Xóa</a>
                                    </div>
                                  </button>
                                </div>
                             </td>
                             <td data-toggle="modal" data-target="#edit-cust" class="btn-edit" data-id="{{$element->id}}" action="{{ url('lecturers/topic/edit-modal') }}">{{$element->name}}</td>
                             <td>{{$element->description}}</td>
                             <td>
                              @if ($element->accept == 1)
                               <span class="badge badge-success">Đã duyệt</span>
                              @else
                               <span class="badge badge-danger">Chưa duyệt</span>
                              @endif</td>
                            
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
      <div class="modal fade" id="create-cust">
        <div class="modal-dialog bounceInRight animated">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm mới đề tài</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ url('lecturers/topic/add-topic') }}" method="POST" id="frm-add" onsubmit="return false;">
               @csrf
                <div class="form-group">
                    <label for="department">Tên Đề tài</label>
                    <textarea name="name" class="form-control" rows="4" data-rule-required="true" data-msg-required="Vui lòng nhập tên để tài."></textarea>
                </div>
                <div class="form-group">
                    <label for="department">Mô tả Đề tài</label>
                    <textarea name="description" rows="6" class="form-control" data-rule-required="true" data-msg-required="Vui lòng nhập mô tả."></textarea>
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
      <div class="modal fade" id="edit-cust">
        <div class="modal-dialog bounceInRight animated">
          <form action="{{ url('lecturers/topic/edit-topic') }}" method="POST" id="frm-update" onsubmit="return false;">
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
                    $("#create-cust").modal('hide');
                    $('#frm-add')[0].reset();
                    if(data.status == '_success') {
                      Toast.fire({
                            type: 'success',
                            title: data.msg
                        }).then(() => {
                        location.reload();
                      });
                    } else {
                        Toast.fire({
                              type: 'error',
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
              $("#edit-cust").modal('hide');
              $('#frm-update')[0].reset();
              if(data.status == '_success') {
                  Toast.fire({
                      type: 'success',
                      title:  data.msg,
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
      <script>
         $('#tabletopic').DataTable({
            "columnDefs": [
              { "orderable": false, "targets": 0 },
              ],
            "order": [],
         });
      </script>
@endsection