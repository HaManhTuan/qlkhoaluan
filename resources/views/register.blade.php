<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- SweetAlert2 -->
  <link rel="stylesheet" href="resource/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="resource/plugins/toastr/toastr.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="resource/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="resource/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="resource/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
<script src="resource/plugins/jquery/jquery.min.js"></script>
  <!-- SweetAlert2 -->
<script src="resource/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="resource/plugins/toastr/toastr.min.js"></script>
<script src="resource/sweetalert2.all.js"></script>
</head>
<body class="hold-transition register-page">
  @if(Session::has('flash_message_success'))
<script>
  $(document).ready(function() {
    $("#frm-register")[0].reset();
   const Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000
   });
     Toast.fire({
         icon: 'success',
        title: "{{ Session::get('flash_message_success') }}"
    });
  });
</script>
 @endif
 @if(Session::has('flash_message_error'))
<script>
  $(document).ready(function() {
      $("#frm-register")[0].reset();
   const Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000
   });
     Toast.fire({
         icon: 'error',
        title: "{{ Session::get('flash_message_error') }}"
    });
  });
  </script>
 @endif
<div class="register-box">
  <div class="register-logo">
    <a href="resource/index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Đăng kí tài khoản giáo viên</p>

      <form action="{{ url('register-post') }}" method="post" id="frm-register">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Tên">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
         @error('name')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
         @error('email')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         @error('password')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Số điện thoại">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
         @error('phone')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
        <div class="input-group mb-3">
          <textarea name="address" class="form-control @error('address') is-invalid @enderror"></textarea>
        </div>
         @error('address')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
        <div class="input-group mb-3">
          <select  class="form-control @error('department') is-invalid @enderror" name="department">
            <option value="">-- Chọn Khoa --</option>
            {!!$data_depart_select!!}
            
          </select>
        </div>
         @error('department')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
          <div class="input-group mb-3">
          <select  class="form-control @error('fields') is-invalid @enderror" name="fields">
            <option value="">-- Chọn Lĩnh Vực --</option>
            @foreach ($fields as $element)
              <option value="{{$element->id}}">{{$element->name}}</option>
            @endforeach
            
          </select>
        </div>
         @error('fields')
              <small class="text-danger font-16">{{ $message }}.</small>
          @enderror
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Đăng kí</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="{{ url('login') }}" class="text-center">Nếu bạn đã có tài khoản giáo viên ?</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


<!-- Bootstrap 4 -->
<script src="resource/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="resource/dist/js/adminlte.min.js"></script>
</body>
</html>
