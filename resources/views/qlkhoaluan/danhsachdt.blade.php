@extends('layout')
@section('content')
<style type="text/css" media="screen">
  .trTable:hover{
    cursor: pointer;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý khóa Luận Sinh Viên đã đăng ký</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("ql-khoaluan")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh sách đề tài</li>
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
                 <a href="{{ url('council/export') }}" class="btn btn-success" onclick=""><i class="fa fa-download"></i> Xuất Excel</a>
            </div>
          </div>

        </div>

          <div class="card-body p-4">
            <table  class="table table-bordered table-striped" id="topicRes">
              <thead>
                <tr>
                    
                    <th class="text-center">Tên Đề Tài</th>
                    <th class="text-center">SV</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
              </thead>
              <tbody class="ajax-loadlist-customer">
                @foreach ($TopicProtection as $element)
                <tr class="trTable" onclick="window.location.href='{{ url('detail-kl/'.$element->id) }}'">
                  
                   <td>{{$element->topics->name}}</td>
                   <td>{{$element->students->name}}</td>
                   <td class="text-center">
                        @if ($element->acceptance == 1)
                           <span class="badge badge-success change_status" data-id="{{ $element->id }}">Active</span>
                        @else
                          <span class="badge badge-danger change_status" data-id="{{ $element->id }}">Unactive</span>
                        @endif
                   </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
       <!-- DataTables -->
  <link rel="stylesheet" href="resource/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="resource/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="resource/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="resource/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $("#topicRes").DataTable();
</script>
  @endsection
