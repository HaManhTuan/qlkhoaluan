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
          @if (isset($TopicProtection) && $TopicProtection->count() > 0 && $TopicProtection->acceptance == 1)
            <div class="callout callout-success">
              <h5>Thông báo! Bạn đã đăng kí đề tài:</h5>
              <p>{{$TopicProtection->topics->name}}.</p>
              <p>GVHD: {{$Topics->branches->name_lecturer}}</p>
              <p>Email: {{$Topics->branches->email_address_lecturer}}</p>
              <p>SĐT: {{$Topics->branches->phone_number}}</p>
              <p>Địa chỉ: {{$Topics->branches->address_lecturer}}</p>
              <p>Đợt bảo vệ dự kiến: {{$Protections->name}}</p> 
              <p>Thời gian dự kiến: {{$Protections->time_start}} - {{$Protections->time_end}}</p><br>
              @php
                $check_student = DB::table('student_council')->where('msv',$data_student->msv)->first();
              @endphp
              @if (isset($check_student) && $check_student != "")
                 <p>Bạn đã được phân vào hội đồng:  {{$check_student->council}}</p><br><br>
              @endif
              @if (isset($check_student->score) && $check_student->score != "")
                <p>Kết quả bảo vệ</p>
                <p>Điểm của bạn:  {{$check_student->score}} điểm</p>
                <p>Trạng thái:  @if ($check_student->pass == 1)
                  <span class="badge badge-success">Qua</span>
                  @else
                  <span class="badge badge-danger">Trượt</span>
                @endif</p>
              @endif
             

            </div>
          @elseif(isset($TopicProtection) && $TopicProtection->count() > 0)
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
                  <label for="id_protection">Đợt bảo vệ</label>
                  <select name="id_protection" class="form-control" id="id_protection">
                      <option value="" disabled="disabled" selected="selected">--- Chọn Đợt Bảo Vệ---</option>
                      @foreach ($protectionsdata as $element)
                         <option value="{{$element->id}}">{{$element->name}}</option>
                      @endforeach
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