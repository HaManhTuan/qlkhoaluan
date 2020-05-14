@extends('layouts.lecturers.lecturers')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Quản Lý</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url("/")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">trang chủ</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{count($topics)}}</h3>

                <p>Đề tài đã đăng</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{count($topics_accept)}}<sup style="font-size: 20px"></sup></h3>

                <p>Đề tài được duyệt</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Danh sách đề tài cần hướng dẫn</h4>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <table  class="table table-bordered table-striped" id="studentTable">
              <thead>
                <tr>
                    <th class="text-center" style="background-color: #fff;width: 50px;">
                      <input type="checkbox" id="checkall"/>
                    </th>
                    <th class="text-center">Tên Đề Tài</th>
                    <th class="text-center">SV</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
              </thead>
              <tbody class="ajax-loadlist-customer">
                @foreach ($TopicProtection as $element)
                <tr class="trTable">
                   <td class="text-center"><input type="checkbox" class="checkbox" name="topics_id" value="{{$element->id}}"/></td>
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
</div>
@endsection