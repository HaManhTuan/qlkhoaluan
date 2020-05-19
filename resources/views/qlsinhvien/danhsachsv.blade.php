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
        </div>
        <div class="card-body p-4">
          <table  class="table table-bordered table-striped" id="studentTable">
                <thead>
                <tr>
                    <th class="text-center">Mã Sinh Viên</th>
                    <th class="text-center">Tên Sinh Viên</th>
                    <th class="text-center">Ngành</th>
                    <th class="text-center">Lớp</th>
                   
                </tr>
                </thead>
                <tbody>
                  @foreach ($dataStudent as $element)
                    <tr>
                      <td>{{$element->msv}}</td>
                      <td>{{$element->name}}</td>
                      <td>{{$element->branches->name}}</td>
                      <td>{{$element->classes->name}}</td>
                      <td></td>
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
$("#studentTable").DataTable({
            "columnDefs": [
              { "orderable": false, "targets": 4 },
              ],
            "order": [],
         });
</script>


@endsection
