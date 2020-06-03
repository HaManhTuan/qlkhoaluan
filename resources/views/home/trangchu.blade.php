@extends('layout')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.css">
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$count_topic}}</h3>

                <p>Đề tài</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ url('detaigv') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$count_topic_pro}}</h3>

                <p>Sinh viên đăng kí</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('danhsachsvdk') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$count_lecturers}}</h3>

                <p>Giảng viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('qlgiangvien') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$count_protections}}</h3>
                <p>Đợt bảo vệ</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('danhsachdbv') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row mb-2">
              <div class="col-sm-6">
                <h4 class="m-0 text-dark">Thống kê số đề tài được chọn</h4>
              </div><!-- /.col -->
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-body p-4">
                <canvas id="topicPie"></canvas>
              </div>
             </div>
          </div>
          </div>
        </div>
     
        <script>
          $(function () {
            var topicPie = $('#topicPie').get(0).getContext('2d');
            var data = {
                datasets: [{
                    data:  {!! json_encode($topic) !!},
                    backgroundColor: [
                     'rgb(255, 99, 132)',
                     'rgb(255, 159, 64)',
                     'rgb(255, 205, 86)',
                     'rgb(75, 192, 192)',
                     'rgb(54, 162, 235)',
                     'rgb(153, 102, 255)',
                     'rgb(201, 203, 207)'
                    ],
                    label: 'Dataset 1'
                }],
                labels: {!! json_encode($fields) !!}
            }
            var options = {
             responsive: true,
             legend: {
                  position: 'top',
              },
              title: {
                  display: true,
                  text: ''
              },
              animation: {
                  animateScale: true,
                  animateRotate: true
              }
            }
            var myPieChart = new Chart(topicPie, {
                type: 'pie',
                data: data,
                options: options
            });
          });
        </script>
        <div class="row mb-2">
              <div class="col-sm-6">
                <h4 class="m-0 text-dark">Thống kê số sinh viên trượt và đạt</h4>
              </div><!-- /.col -->
        </div>
        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        <script>
          $(function () {
            var areaChartCanvas = $('#barChart').get(0).getContext('2d');

            var areaChartData = {
              labels  : {!! json_encode($idin) !!},
              datasets: [
                {
                  label               : 'Học sinh trượt',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : {!! json_encode($fail) !!}
                },
                {
                  label               : 'Học sinh qua',
                  backgroundColor     : 'rgba(210, 214, 222, 1)',
                  borderColor         : 'rgba(210, 214, 222, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : {!! json_encode($pass) !!}
                },
              ]
            }
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]

            barChartData.datasets[0] = temp0
            barChartData.datasets[1] = temp1


            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }

            var barChart = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })

            
          })
        </script>
  </div><!-- /.container-fluid -->
</section>


</div>
@endsection