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
          <div class="card-tools">
            <div class="btn-groups">
                 <button type="button" class="btn btn-primary" data-toggle="modal"
                         data-target="#create-cust"><i class="fa fa-plus-circle"></i> Thêm Giảng viên
                 </button>
            </div>
          </div>

        </div>

        <div class="card-body p-0">
          <table  class="table table-bordered">
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
                                {{ $element->lecturers_id}}
                                @php
                                  $countTopicAcc = DB::table('topics')->where(['lecturers_id' => $element->id, 'accept' => 1])->count();
                                @endphp
                                  <div class="progress">
                                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="{{$countTopicAcc}}" aria-valuemin="0" aria-valuemax="{{ count($element->topics)}}" style="width: {{($countTopicAcc/count($element->topics))*100}}%">
                                      <span class="sr-only">{{($countTopicAcc/count($element->topics))*100}}% Complete (success)</span>
                                    </div>
                                  </div>
                                   <p class="text-center">{{$countTopicAcc }}/{{ count($element->topics)}} đề tài </p>
        
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

@endsection
