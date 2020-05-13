@extends('layouts.students.students')
@section('content')
@if(Session::has('flash_message_error'))
<script>
$(document).ready(function() {
 const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
   Toast.fire({
       type: 'error',
      title: "{{ Session::get('flash_message_error') }}"
  });
});
</script>
 @endif
 @if(Session::has('flash_message_success'))
<script>
$(document).ready(function() {
 const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
   Toast.fire({
       type: 'success',
      title: "{{ Session::get('flash_message_success') }}"
  });
});
</script>
 @endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Đăng kí đề tài</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Quản Lý Đề tài của bạn</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card">
        <div class="card-body p-4">
          @if ($TopicProtection->count() > 0)
          <div class="callout callout-danger">
            <h5>Thông báo! Bạn đã đăng kí đề tài:</h5>

            <p>{{$TopicProtection->topics->name}}.</p>
          </div>
            @else
          <form action="{{ url('students/register-post-topic') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="department">Lĩnh Vực</label>
                <select name="field_id" class="form-control col-md-7" id="field_id">
                   <option value="" disabled="disabled" selected="selected">--- Chọn Lĩnh Vực ---</option>
                   {!!$data_field_select!!}
                </select>
            </div>
            <div class="form-group">
                <label for="topics_id">Đề Tài</label>
                <select name="topics_id" class="form-control" id="topics_id">
                    <option value="" disabled="disabled" selected="selected">--- Chọn Đề Tài---</option>
                </select>
            </div>
          <div class="form-group">
            
         
             <button type="submit" class="btn btn-primary btn-register">Đăng kí</button>
            @endif
           
            
          </div>
          </form>
        </div>
      </div>
    </section>
</div>
<script>
  // Change
  $("#field_id").change(function() {
      let field_id = $(this).val();
      if ($.trim(field_id) != '') {
          $.ajax({
              url: '{{ url('students/change-register-fields')}}',
              type: 'POST',
              data: {field_id: field_id},
              dataType: 'JSON',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(data) {
                //console.log(data);
                  let branches_html = "";
                  if (data  != "") {
                    $.each(data, function(index, value) {
                        branches_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                      
                    });
                    $("#topics_id").html(branches_html);
                  }
                  else{
                    $(".btn-register").hide();
                  }

              },
              error: function(err) {
                  console.log(err);
                  Swal({
                      title: 'Error ' + err.status,
                      text: err.responseText,
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonText: 'OK',
                      type: 'error'
                  });
              }
          });
      }
  });
</script>
@endsection