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
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Thay đổi Tài Khoản</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("tai-khoan")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Thay tài Khoản</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <div class="card">
    <div class="card-body p-5">
  <form action="{{ url('/edit-post-user') }}" method="POST" enctype="multipart/form-data" id="frm-edit-user">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $dataUserId->id }}">
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Name</label>
                        <input  type="text" value="{{ $dataUserId->name }}" class="col-md-7 form-control" id="name" name="name" data-rule-required="true"  data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Email</label>
                        <input  type="email" class="col-md-7 form-control" value="{{ $dataUserId->email }}" id="email" name="email" data-rule-required="true"  data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Password</label>
                        <input  type="password" class="col-md-7 form-control"  id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Phone</label>
                        <input  type="text" value="{{ $dataUserId->phone }}" class="col-md-7 form-control" id="phone" name="phone" data-rule-required="true" data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="admin" {{ (isset($dataUserId) && $dataUserId->admin == "1") ? 'checked' : '' }}  class="custom-control-input"><span class="custom-control-label"> Active</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Edit
                            <span class="btn btn-primary btn-xs select-all">Select all</span>
                            <span class="btn btn-warning btn-xs deselect-all">Delselec all</span>
                        </label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" data-rule-required="true" data-msg-required="This field cannot be blank.">
                            @foreach($roles as $id => $roles)
                            <option value="{{ $id }}" {{  isset($dataUserId) && $dataUserId->roles()->pluck('name', 'id')->contains($id) ? 'selected' : '' }}>{{ $roles }}</option>
                        @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
    </div>  
  </div>
</div>
  <link rel="stylesheet" href="resource/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="resource/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
    $('.select2').select2()
</script>
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
    $(document).ready(function () {
        $("#frm-add-user").validate();
    });
</script>
@endsection