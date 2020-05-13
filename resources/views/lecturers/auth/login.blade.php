<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng Nhập</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="{{ asset('') }}" >
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
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="resource/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="resource/plugins/toastr/toastr.min.css">
  <!-- jQuery -->
<script src="resource/plugins/jquery/jquery.min.js"></script>
    <script src="resource/jquery.validate.min.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a ><b>Đăng Nhập</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Tài Khoản Đăng Nhập Giáo Viên</p>

        <form action="{{ url('lecturers/dang-nhap') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
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
          <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         @error('password')
                <small class="text-danger font-16">{{ $message }}.</small>
            @enderror
        <div class="row">
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Đăng Nhập"> 
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="social-auth-links text-center mb-3">
        <p></p>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<!-- Bootstrap 4 -->
<script src="resource/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="resource/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="resource/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="resource/plugins/toastr/toastr.min.js"></script>

@if(Session::has('flash_message_error'))
<script>
$(document).ready(function() {
 const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 2000
 });
   Toast.fire({
       icon: 'error',
      title: "{{ Session::get('flash_message_error') }}"
  });
});
</script>
@endif
</body>
</html>
