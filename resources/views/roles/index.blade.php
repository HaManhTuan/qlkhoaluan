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
            <h4>Quản Lý Luật</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thông tin luật</li>
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
                 <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('user/add-roles') }}'"><i class="fa fa-plus-circle"></i> Thêm luật
                 </button>
            </div>
          </div>

        </div>

        <div class="card-body p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên </th>
                            <th scope="col">Quyền</th>
                            <th scope="col" style="width:200px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr>
                            <th scope="row"> {{ $role->id ?? '' }}</th>
                            <td> {{ $role->name ?? '' }}</td>
                            <td>
                                @foreach($role->permissions()->pluck('name') as $permission)
                                    <span class="badge badge-primary">{{ $permission }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('edit_user')
                                <a href="{{ url('user/edit-roles/'.$role->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt mr-1"></i>Edit</a>
                                @endcan
                                @can('delete_user')
                                <a action="{{ url('user/del-post-roles') }}" class="btn btn-danger btn-del" data-id="{{ $role->id }}"><i class="fas fa-trash mr-1"></i>Delete</a>
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
