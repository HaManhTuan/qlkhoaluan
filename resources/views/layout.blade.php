<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UTT | Admin</title>
  <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="resource/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="resource/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="resource/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="resource/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="resource/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="resource/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="resource/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="resource/plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="resource/animate.css">
      <!-- SweetAlert2 -->
  <link rel="stylesheet" href="resource/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="resource/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
<script src="resource/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="resource/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- SweetAlert2 -->
<script src="resource/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="resource/plugins/toastr/toastr.min.js"></script>
<script src="resource/sweetalert2.all.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
  <script src="resource/jquery.validate.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route("trang-chu")}}" class="nav-link">Trang Chủ</a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
       

     <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="" href="{{ route('dang-xuat') }}">
          <i class="nav-icon fas fa-sign-out-alt">Đăng Xuất</i>
        </a>
      </li>
     
    </ul>
    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("trang-chu")}}" class="brand-link">
      <img src="resource/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="resource/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">QUẢN LÝ</li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Quản Lý Hội Đồng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("ql-hoidong")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Hội Đồng</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản Lý Khóa Luận
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("ql-khoaluan")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Đề Tài</p>
                </a>
              </li>
              </li>

            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("dangki-dt")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đăng Kí Đề Tài</p>
                </a>
              </li>
              </li>
              
            </ul>
          </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Quản Lý Sinh Viên
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("ql-sinhvien")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Sinh Viên</p>
                </a>
              </li>
            </ul>
          </li>
          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Quản Lý Giảng Viên
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("ql-giangvien")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Giảng Viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("danhsach-svdk")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Sinh viên Đăng Kí  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("detai-gv")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đề Tài Của Bạn </p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản Lý Lĩnh Vực
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("ql-linhvuc")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản Lý Lĩnh Vực</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("ql-khoa")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản Lý Khoa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("ql-nganh")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản Lý Ngành</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("ql-lop")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản Lý Lớp</p>
                </a>
              </li>

            </ul>
          </li>

         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Quản Lý Đợt Bảo Vệ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("danhsach-dbv")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Đợt Bảo Vệ</p>
                </a>
              </li>
              
            </ul>
          </li>


          <li class="nav-header">TÀI KHOẢN</li>
  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-card"></i>
              <p>
                Quản Lý Tài Khoản
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("tai-khoan")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tài Khoản</p>
                </a>
              </li>
              


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->
<script src="resource/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="resource/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="resource/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="resource/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="resource/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="resource/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="resource/plugins/moment/moment.min.js"></script>
<script src="resource/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="resource/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="resource/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="resource/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="resource/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="resource/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="resource/dist/js/demo.js"></script>
</body>
</html>
