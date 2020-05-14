@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Đợt Bảo Vệ</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thông Tin Đợt Bảo Vệ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body p-4">
          <form action="{{ url('/edit-post-protections') }}" method="POST"
                    enctype="multipart/form-data" id="frm-edit-user">
                    @csrf
                    <input type="hidden" name="id" value="{{$Protections->id}}">
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Tên</label>
                        <input type="text" class="col-md-7 form-control" id="name" name="name" data-rule-required="true"
                            data-msg-required="Hãy nhập mô tả đợt bảo vệ." value="{{$Protections->name}}">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Ngày bắt đầu</label>
                          <input type="date" class="form-control col-md-4" id="start_time" name="start_time" data-rule-required="true" data-msg-required="Vui lòng nhập ngày bắt đầu." value="{{$Protections->time_start}}">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control col-md-4" id="end_time" name="end_time" data-rule-required="true" data-msg-required="Vui lòng nhập ngày kết thúc." value="{{$Protections->time_end}}">
                    </div>
                     <div class="form-group">
                    <label for="exampleInputPassword1 " class="mr-5">Trạng thái</label>
                   
                    <input type="checkbox" {{ ($Protections->accept == '1') ? 'checked' : '' }} data-on-color="success" data-off-color="warning" id="accept" name="accept" data-on-text="Xác nhận" data-off-text="Đang duyệt">
                  </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Chỉnh sửa</button>
                    </div>
      </form>
        </div>
        </div>
      </div>
    </section>
</div>
 <script src="resource/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $("#accept").bootstrapSwitch();
</script>
<script>
  $(document).ready(function() {
      $("#frm-edit-user").validate();
  });
</script>
@endsection
