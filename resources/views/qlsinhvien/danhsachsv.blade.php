@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Sinh Viên</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh Sách Sinh Viên</li>
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
          @if(count($errors) > 0)
              <div class="alert alert-danger">
               Upload Validation Error<br><br>
               <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
               </ul>
              </div>
             @endif

             @if($message = Session::get('success'))
             <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>{{ $message }}</strong>
             </div>
             @endif

              <form method="POST" enctype="multipart/form-data" action="{{ url('import-sv') }}">
                {{ csrf_field() }}
                <div class="form-group">
                 <table class="table">
                  <tr>
                   <td width="40%" align="right"><label>Import Excel</label></td>
                   <td width="30">
                    <input type="file" name="select_file" />
                   </td>
                   <td width="30%" align="left">
                    <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                   </td>
                  </tr>
                 </table>
                </div>
               </form>
                         <div class="card-tools">
            <div class="btn-groups">
                 <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('add-sv') }}'"><i class="fa fa-plus-circle"></i> Thêm 
                 </button>
            </div>
          </div>
        </div>
        <div class="card-body p-4">
          <table  class="table table-bordered table-striped" id="studentTable">
                <thead>
                <tr>
                    <th class="text-center">Mã Sinh Viên</th>
                    <th class="text-center">Tên Sinh Viên</th>
                    <th class="text-center">Ngành</th>
                    <th class="text-center">Lớp</th>
                    <th class="text-center">#</th>
                   
                </tr>
                </thead>
                <tbody>
                  @foreach ($dataStudent as $element)
                    <tr>
                      <td>{{$element->msv}}</td>
                      <td>{{$element->name}}</td>
                      <td>{{$element->branches->name}}</td>
                      <td>{{$element->classes->name}}</td>
                      <td>
                        <a href="{{ url('edit-sv/'.$element->id) }}" class="btn btn-primary">Sửa</a>
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
   <!-- DataTables -->
  <link rel="stylesheet" href="resource/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="resource/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="resource/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="resource/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
$("#studentTable").DataTable();
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
          url: '{{ url('delete-sv') }}',
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
