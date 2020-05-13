@extends('layout')
@section('content')
<style type="text/css" media="screen">
    .select2-selection__choice{
        background-color: #6f42c1 !important;
        border: 1px solid #6f42c1 !important;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
</style>
  <link rel="stylesheet" href="resource/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="resource/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Thêm mới Luật</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thêm mới luật</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card">
        <div class="card-body p-4">
            <form action="{{ url('/user/add-post-roles') }}" method="POST" enctype="multipart/form-data" id="frm-add-role">
                    @csrf
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Tên</label>
                        <input id="inputText3" type="text" class="form-control" id="name" name="name" data-rule-required="true" data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Quyền
                            <span class="btn btn-primary btn-xs select-all">Chọn hết</span>
                            <span class="btn btn-warning btn-xs deselect-all">Bỏ hết</span>
                        </label>
                        <select name="permission[]" id="permission" class="form-control select2" multiple="multiple" data-rule-required="true" data-msg-required="This field cannot be blank." data-dropdown-css-class="select2-purple">
                            @foreach($permissions as $id => $permissions)
                                <option value="{{ $id }}">{{ $permissions }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Lưu</button>
                    </div>
            </form>
        </div>
      </div>
    </section>
</div>
<script>
    $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
      })
      $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
      })
      $('.select2').select2()
</script>
<script>
    $(document).ready(function() {
        $("#frm-add-role").validate();
    });
</script>
@endsection
