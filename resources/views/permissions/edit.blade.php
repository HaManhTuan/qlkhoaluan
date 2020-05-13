@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Thay đổi Quyền</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thay đổi quyền</li>
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
            <form action="{{ url('/user/edit-post-permissions') }}" method="POST" enctype="multipart/form-data" id="frm-edit-per">
                @csrf
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Tên quyền</label>
                    <input id="inputText3" type="hidden" class="form-control" id="id" name="id" value="{{ $permission_detail->id}}">
                    <input id="inputText3" type="text" class="form-control" value="{{ $permission_detail->name}}" id="name" name="name" data-rule-required="true" data-msg-required="This field cannot be blank.">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</section>
</div>
    
<script>
    $(document).ready(function() {
        $("#frm-edit-per").validate();
    });
</script>
@endsection
