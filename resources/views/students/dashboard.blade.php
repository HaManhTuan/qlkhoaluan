@extends('layouts.students.students')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Xin chào - {{ Auth::guard('students')->user()->name}}</h4>
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
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-lg-12">
           @if (isset($TopicProtection) && $TopicProtection->acceptance == 1)
          <div class="alert alert-success alert-dismissible bounceInDown animated">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
              <p>Đề tài: "{{$TopicProtection->topics->name}}" của bạn đã được duyệt</p>
              <a href="{{ url('students/register-topic') }}">Xem chi tiết</a>
          </div>
           @endif
        </div>
      </div>
      <div class="card card-primary col-md-12">
              <div class="card-header">
                <h3 class="card-title">Thông tin tài khoản</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mã SV</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" readonly="" value="{{$Students->msv}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Khoa </label>
                        <input type="text" class="form-control" id="exampleInputPassword1" readonly="" value="{{$Students->department->name}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Ngành </label>
                        <input type="text" class="form-control" id="exampleInputPassword1" readonly="" value="{{$Students->branches->name}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Lớp </label>
                        <input type="text" class="form-control" id="exampleInputPassword1" readonly="" value="{{$Students->classes->name}}">
                  </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-primary" data-toggle="modal"
                         data-target="#create-depart">Đổi mật khẩu</button>
                </div>
          
      </div>
    </section>
</div>
    {{-- Modal-add --}}
      <div class="modal fade" id="create-depart">
        <div class="modal-dialog bounceInRight animated">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Đổi mật khẩu</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ url('/students/change-password') }}" method="POST" id="change-password-form" onsubmit="return false;">
               @csrf
               <input type="hidden" name="id" value="{{Auth::guard('students')->user()->id}}">
                <div class="form-group">
                    <label for="new-pwd">Mật khẩu mới</label>
                    <input type="password" id="new-pwd" name="newPwd" class="form-control" placeholder="Nhập mật khẩu mới" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu mới" data-rule-minlength="6" data-msg-minlength="Mật khẩu ít nhất 6 kí tự"/>
                </div>
                <div class="form-group">
                    <label for="retype-new-pwd">Nhập lại mật khẩu</label>
                    <input type="password" id="retype-new-pwd" name="retypeNewPwd" class="form-control" placeholder="Nhập lại mật khẩu" data-rule-required="true" data-msg-required="Vui lòng nhập lại mật khẩu" data-rule-equalto="#new-pwd" data-msg-equalto="Mật khẩu không khớp" data-rule-minlength="6" data-msg-minlength="Mật khẩu ít nhất 6 kí tự"/>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary btn-save" id="btn-save-new-pwd">Thay đổi</button>
            </div>
          </div>
           </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <script>
         $("#btn-save-new-pwd").click(function() {
                let form = $("#change-password-form");
                form.validate({
                    submitHandler: function() {
                        let action, method, formData;
                        action = form.attr('action');
                        method = form.attr('method');
                        formData = form.serialize();
                        $.ajax({
                            url: action,
                            type: method,
                            data: formData,
                            success: function(data) {
                              console.log(data);
                                if (data.status == '_error') {
                                    Swal({
                                        title: data.msg,
                                        showCancelButton: false,
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK',
                                        type: 'error'
                                    });
                                } else {
                                    Swal({
                                        title: data.msg,
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        type: 'success',
                                        timer: 2000
                                    }).then(() => {
                                        location.reload();
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
                });
});
      </script>
@endsection