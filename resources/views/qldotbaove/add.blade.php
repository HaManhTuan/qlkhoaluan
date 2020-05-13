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
          <form action="{{ url('/add-post-protections') }}" method="POST"
                    enctype="multipart/form-data" id="frm-add-user">
                    @csrf
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Tên</label>
                        <input type="text" class="col-md-7 form-control" id="name" name="name" data-rule-required="true"
                            data-msg-required="Hãy nhập mô tả đợt bảo vệ.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Ngày bắt đầu</label>
                          <input type="date" class="form-control col-md-4" id="start_time" name="start_time" data-rule-required="true" data-msg-required="Vui lòng nhập ngày bắt đầu.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control col-md-4" id="end_time" name="end_time" data-rule-required="true" data-msg-required="Vui lòng nhập ngày kết thúc.">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Lưu</button>
                    </div>
      </form>
        </div>
        </div>
      </div>
    </section>
</div>
<script>
  $(document).ready(function() {
      $("#frm-add-user").validate();
  });
</script>
@endsection
