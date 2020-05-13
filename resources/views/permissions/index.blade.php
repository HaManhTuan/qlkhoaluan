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
       type: 'error',
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
       type: 'success',
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
            <h4>Quản Lý Quyền</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thông tin quyền</li>
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
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-cust"><i class="fa fa-plus-circle"></i> Thêm quyền
                 </button>
            </div>
          </div>

        </div>

        <div class="card-body p-4">

                  <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên quyền</th>
                            <th scope="col" style="width:200px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $key => $permission)
                        <tr>
                            <th scope="row"> {{ $permission->id ?? '' }}</th>
                            <td> {{ $permission->name ?? '' }}</td>
                            <td>
                                @can('edit_user')
                                <a href="{{ url('/user/edit-permissions/'.$permission->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt mr-1"></i>Edit</a>
                                @endcan
                                @can('delete_user')
                                <a href="#" action="{{ url('/user/del-post-permissions') }}" class="btn btn-danger btn-del" data-id="{{ $permission->id }}"><i class="fas fa-trash mr-1"></i>Delete</a>
                                @endcan
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
      <div class="modal fade" id="create-cust">
        <div class="modal-dialog bounceInRight animated">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm mới quyền</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ url('user/add-post-permissions') }}" method="POST" id="frm-add" onsubmit="return false;">
               @csrf
                <div class="form-group">
                    <label for="fields">Tên quyền</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Hãy nhập tên quyền" data-rule-required="true" data-msg-required="Vui lòng nhập tên quyền.">
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
       timer: 2000
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
             
              $('#frm-add')[0].reset();
               $("#create-cust").modal('hide');
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
  </script>
<script>
  $(document).on("click", ".btn-del", function() {
    let id = $(this).attr('data-id');
    let action = $(this).attr('action');
    Swal({
        title: 'Are you sure?',
        type: 'error',
        html: '<p>Once deleted !</p><p>You will not be able to recover this imaginary file!?</p>',
        showConfirmButton: true,
        confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>OK',
        confirmButtonColor: '#ef5350',
        cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Cancell',
        showCancelButton: true,
        focusConfirm: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                url: action,
                type: 'POST',
                data: { id: id },
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
                            window.location.reload();
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
