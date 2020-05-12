 @extends('layout')
 @section('content')

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
    <div class="card-body login-card-body">
      <p class="login-box-msg">Đổi Mật Khẩu</p>

      <form action="login.html" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Mật khẩu cũ">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder=" Mật khẩu mới">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder=" Ghi mật khẩu mới">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Đổi Mật Khẩu</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
    </div>
    <!-- /.login-card-body -->
  </div>

   </div>

@endsection