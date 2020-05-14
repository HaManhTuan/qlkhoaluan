@extends('layout')
@section('content')
<style type="text/css" media="screen">
  .change_status:hover{
    cursor: pointer;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Giảng Viên</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh Sách Giảng Viên</li>
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
              <form method="POST" enctype="multipart/form-data" action="{{ url('import-gv') }}">
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

        </div>

        <div class="card-body p-4">
          <table  class="table table-bordered" id="lecturersTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="background-color: #fff;width: 50px;">TT</th>
                            <th class="text-center">Tên Giảng Viên</th>
                            <th class="text-center">Số đề tài</th>
                            <th class="text-center" style="width: 100px">Trạng thái</th>
                            <th class="text-center" style="background-color: #fff;width: 250px;">Hành động</th>
                        </tr>
                        </thead>
                        <tbody class="ajax-loadlist-customer">
                          @foreach ($lecturers as $element)
                            <tr>
                              <td>{{$element->id}}</td>
                              <td>{{$element->name_lecturer}}</td>
                              <td class="project_progress">
                                @if ($element->status == 1)
                                @php
                                  $countTopicAcc = DB::table('topics')->where(['lecturers_id' => $element->id, 'accept' => 1])->get();
                                  // print_r(count($countTopicAcc));
                                  // die();
                                @endphp
                                @if (isset($countTopicAcc) && $countTopicAcc != "")
                                @if (count($element->topics) > 0) 
                                  <div class="progress">
                                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="{{(count($countTopicAcc))}}" aria-valuemin="0" aria-valuemax="{{ count($element->topics)}}" 
                                      style="
                                      width: {{(count($countTopicAcc)/count($element->topics))*100}}%
                                      ">
                                      <span class="sr-only">
                                        {{(count($countTopicAcc)/count($element->topics))*100}}% Complete (success)
                                      </span>
                                    </div>
                                  </div>
                                   <p class="text-center">{{count($countTopicAcc) }}/{{ count($element->topics)}} đề tài </p>
                                @else
                                   <p class="text-center">{{count($countTopicAcc) }}/{{ count($element->topics)}} đề tài </p>
                                @endif
                                  
                                @endif
                                @endif
                               
        
                              </td>
                              <td class="project-state text-center">
                                @if ($element->status == 1)
                                  <span class="badge badge-success change_status" data-id="{{ $element->id }}">Active</span>
                                @else
                                  <span class="badge badge-danger change_status" data-id="{{ $element->id }}">Unactive</span>
                                @endif
                              </td>
                              <td class="project-actions text-center">
                                  <a class="btn btn-primary btn-sm" href="{{ url('chi-tiet-gv/'.$element->id) }}">
                                      <i class="fas fa-folder">
                                      </i>
                                      Xem
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Sửa
                                  </a>
                                  <a class="btn btn-danger btn-sm" href="#">
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
        url: '{{ url('change-status') }}',
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
</script>
 <!-- DataTables -->
  <link rel="stylesheet" href="resource/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="resource/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="resource/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="resource/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
$("#lecturersTable").DataTable({
            "columnDefs": [
              { "orderable": false, "targets": 4 },
              ],
            "order": [],
         });
</script>
@endsection
