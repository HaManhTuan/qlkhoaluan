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
            <h4>Chi Tiết Khóa Luận</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/index') }}">Trở Về</a></li>
              <li class="breadcrumb-item active">Chi Tiết Khóa Luận</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sinh viên thực hiện: {{$TopicProtection->students->name}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ url('change-detail-kl') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value=" {{$TopicProtection->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên Đề Tài</label>
                    <p>
                      {{$TopicProtection->topics->name}}
                    </p>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Giáo viên hướng dẫn</label>
                    <p>{{$gvhd->name_lecturer}}</p>
                    <label for="exampleInputPassword1">Khoa: </label>
                    <span class="mr-5"> {{$gvhd->department->name}}</span>
                    <label for="exampleInputPassword1">Số điện thoại: </label>
                    <span class="mr-5"> {{$gvhd->phone_number}} </span>
                    <label for="exampleInputPassword1">Email: </label>
                    <span class="mr-5"> {{$gvhd->email_address_lecturer}} </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Sinh viên thực hiện</label>
                    <p>{{$TopicProtection->students->name}}</p>
                    <label for="exampleInputPassword1">Khoa: </label>
                    <span class="mr-5"> {{$Students->department->name}}</span>
                    <label for="exampleInputPassword1">Ngành: </label>
                    <span class="mr-5"> {{$Students->branches->name}} </span>
                    <label for="exampleInputPassword1">Số điện thoại: </label>
                    <span class="mr-5"> {{$Students->phone}} </span>
                    <label for="exampleInputPassword1">Email: </label>
                    <span class="mr-5"> {{$Students->email}} </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="mr-5">Đợt bảo vệ: </label>
                    <span>
                      {{$TopicProtection->protections->name}}
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="mr-5">Thời gian dự kiến: </label>
                    <span>
                      {{$Protections->time_start}} - {{$Protections->time_end }}
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1 " class="mr-5">Trạng thái</label>
                   
                    <input type="checkbox" {{ ($TopicProtection->acceptance == '1') ? 'checked' : '' }} data-on-color="success" data-off-color="warning" id="status" name="status" data-on-text="Xác nhận" data-off-text="Đang duyệt">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1 " class="mr-5">Ngày đăng ký:</label>
                    {{ $TopicProtection->created_at}}
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thay đổi trạng thái</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
           
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
         
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <script src="resource/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $("#status").bootstrapSwitch();
</script>
  @endsection