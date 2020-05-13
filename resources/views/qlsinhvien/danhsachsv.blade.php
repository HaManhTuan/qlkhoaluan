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
        
{{--               <div class="row" align="center">
                <div class="col-md-3">
                  <select name="branch_id" class="form-control" style="padding-top: 5px;" id="filter_branches">
                    <option>--Ngành--</option>
                      @foreach($branches as $branches)
                            <option value="{{ $branches->branches->id }}">{{ $branches->branches->name }}</option>
                       @endforeach
                    </select>
                  </div>
                <div class="col-md-3"> 
                   <select name="classes_id" class="form-control" style="padding-top: 5px;" id="filter_classes">
                    <option>--Lớp--</option>
                      @foreach($classes as $classes)
                            <option value="{{ $classes->classes->id }}">{{ $classes->classes->name }}</option>
                       @endforeach
                    </select>
                </div>
                  <div class="col-md-4">
                       <div class="form-group" align="left">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Lọc</button>
                        <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
                    </div>
                  </div>
              </div> --}}
          
        </div>
        <div class="card-body p-4">
          <table  class="table table-bordered table-striped" id="studentTable">
                <thead>
                <tr>
                    <th class="text-center">Mã Sinh Viên</th>
                    <th class="text-center">Tên Sinh Viên</th>
                    <th class="text-center">Ngành</th>
                    <th class="text-center">Lớp</th>
                    <th class="text-center" style="background-color: #fff;">Action</th>
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
