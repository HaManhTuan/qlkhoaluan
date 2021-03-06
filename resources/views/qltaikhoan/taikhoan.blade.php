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
            <h4>Quản Lý Tài Khoản</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("tai-khoan")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Tài Khoản</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <div class="card">
    <div class="card-header">
      <div class="card-tools">
        <div class="btn-groups">
             <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('add-user') }}'"><i class="fa fa-plus-circle"></i> Thêm 
             </button>
        </div>
      </div>
    </div>
    <div class="card-body p-3">
       <table class="table table-bordered">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Email</th>
                  <th scope="col" style="text-align:center">Trạng thái</th>
                  <th scope="col">Luật</th>
                  @can('edit_user')
                  <th scope="col">Hành động</th>
                  @endcan
              </tr>
          </thead>
          <tbody>
              @php
                  $stt = 1;
              @endphp
              @foreach ($dataUser as $item)
              <tr>
                  <th scope="row">{{ $stt++ }}</th>
                  <td>{{ $item['name'] }}</td>
                  <td>{{ $item['email'] }}</td>
                  <td align="center">
                       @if ($item->status == 1)
                          <span class="badge badge-success change_status" data-id="{{ $item->id }}">Active</span>
                        @else
                          <span class="badge badge-danger change_status" data-id="{{ $item->id }}">Unactive</span>
                        @endif
                  <td>
                      @foreach($item->roles()->pluck('name') as $role)
                        <span class="badge badge-info">{{ $role }}</span>
                      @endforeach
                  </td>
                  @can('edit_user')
                  <td>
                      <button class="btn btn-primary" onclick="window.location.href='{{ url('/edit-user/'.$item['id']) }}'">Edit</button>
                      <a action="{{ url('/del-post-user') }}" class="btn btn-danger btn-del" data-id="{{ $item->id }}"><i class="fas fa-trash mr-1"></i>Delete</a>
                  </td>
                  @endcan
              </tr>
              @endforeach
          </tbody>
        </table>
    </div>
  </div>
</div>
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