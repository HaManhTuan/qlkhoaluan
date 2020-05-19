@extends('layout')
@section('content')
<style type="text/css" media="screen">
  .change_status:hover{
    cursor: pointer;
  }
</style>
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
            <h4>Quản Lý Đợt Bảo Vệ</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thông Tin Đợt Bảo Vệ</li>
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
                 <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('add-protection') }}'"><i class="fa fa-plus-circle"></i> Thêm Đợt
                 </button>
            </div>
          </div>
        </div>
        <div class="card-body p-4">
          <table  class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Đợt Bảo Vệ</th>
                    <th class="text-center">Thời Gian Bắt Đầu</th>
                    <th class="text-center">Thời Gian Kết Thúc</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody class="ajax-loadlist-customer">
                  @foreach ($Protections as $element)
                    <tr>
                      <td>{{$element->name}}</td>
                      <td>{{date_format(date_create($element->time_start),'d-m-Y')}}</td>
                     <td>{{date_format(date_create($element->time_end),'d-m-Y')}}</td>
                     <td>
                     @if ($element->accept == 1)
                                  <span class="badge badge-success change_status" data-id="{{ $element->id }}">Active</span>
                                @else
                                  <span class="badge badge-danger change_status" data-id="{{ $element->id }}">Unactive</span>
                                @endif</td>
                     <td>
                       <button class="btn btn-success btn-edit-depart" data-id="{{ $element->id}}"><i class="fas fa-pencil-alt" onclick="window.location.href='{{ url('edit-protection/'.$element->id) }}'"></i></button>
                       <button class="btn btn-danger btn-del" data-id="{{ $element->id}}"><i class="fas fa-trash"></i></button>
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
<script>
  $(document).ready(function() {
     const Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000
    });
    $(".change_status").click(function(){
      let id = $(this).data("id");
      $.ajax({
        url: '{{ url('change-status-hd') }}',
        type: 'POST',
        dataType: 'JSON',
         headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          },
        data: {id: id },
        success:function(data){
          
          if(data.status = "_success"){
            Toast.fire({
                type: 'success',
                title: data.msg
            }).then(() => {
                  location.reload();
                });
          }
         
        },
        error:function(err){
          console.log(err);
        }
      });
    });
  });
      $(".btn-del").on('click',function() {
      let id = $(this).attr('data-id');
      Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp xóa 1 đợt bảo vệ .</p><p>Bạn có chắn chắn muốn xóa?</p>',
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
            url: '{{ url('departmenr/delete') }}',
            type: 'POST',
            data: {id_council: id},
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
                                window.location.href="{{ url('danhsachdbv') }}";
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
