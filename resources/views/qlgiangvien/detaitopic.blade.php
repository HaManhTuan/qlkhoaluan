@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Chi tiết đề tài</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Đề Tài Của GV</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card">        
        <div class="card-body pd-2">
            <form action="" method="POST">
              <div class="form-group">
                  <label for="department">Lĩnh Vực</label>
                  <select name="field" class="form-control">
                    <option value="" selected="" disabled="">---Chọn---</option>
                    {!!$data_fields_select!!}
                  </select>
              </div>
              <div class="form-group">
                  <label for="department">Tên Đề tài</label>
                  <textarea name="name" class="form-control" rows="4" data-rule-required="true" data-msg-required="Vui lòng nhập tên để tài.">{{$detailTopic->name}}</textarea>
              </div>
              <div class="form-group">
                  <label for="department">Mô tả Đề tài</label>
                  <textarea name="description" rows="6" class="form-control" data-rule-required="true" data-msg-required="Vui lòng nhập mô tả.">{{$detailTopic->description}}</textarea>
              </div>
              <div class="form-group">
                  <label for="department">Giáo viên ra đề</label>
                  <textarea name="description" rows="6" class="form-control" data-rule-required="true" data-msg-required="Vui lòng nhập mô tả.">{{$detailTopic->branches->name_lecturer}}</textarea>
              </div>
            </form>
        </div>
      </div>
    </section>
  </div>
@endsection
