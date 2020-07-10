@extends('layout')
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
       icon: 'error',
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
       icon: 'success',
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
            <h4>Thêm Sinh Viên</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Thêm Sinh Viên</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
          <div class="card-body p-4">
            <form action="{{ url('updateSV') }}" method="POST" id="frn-add-sv" >
               @csrf
               <input type="hidden" name="id" value="{{$detail->id  }}">
                <div class="form-group">
                    <label for="department">Mã sinh viên</label>
                    <input type="text" class="form-control" id="msv" name="msv" value="{{$detail->msv  }}" placeholder="Hãy nhập mã sinh viên" data-rule-required="true" data-msg-required="Vui lòng nhập mã sinh viên.">
                </div>
                <div class="form-group">
                    <label for="department">Tên sinh viên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$detail->name }}" placeholder="Hãy nhập tên sinh viên" data-rule-required="true" data-msg-required="Vui lòng nhập mã sinh viên.">
                </div>
                <div class="form-group">
                    <label for="department">Khoa</label>
                     <select name="department_id" class="form-control" id="department" data-rule-required="true" data-msg-required="Vui lòng nhập khoa.">
                       <option value="" disabled="disabled" selected="selected">--- Chọn Khoa ---</option>
                       {!! $data_depart_select !!}
                    </select>
                </div>
                <div class="form-group">
                    <label for="department">Ngành</label>
                    <select name="branches_id" class="form-control" id="braches" data-rule-required="true" data-msg-required="Vui lòng nhập ngành.">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="department">Lớp</label>
                    <select name="classes" class="form-control" id="classes" data-rule-required="true" data-msg-required="Vui lòng nhập lớp.">
                        <option value="" disabled="disabled" selected="selected">--- Chọn Lớp ---</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-save">Lưu</button>
            </form>
          </div>
        </div>
    </section>
</div>
<script>
    $("#department option[value='{{$detail->id_branch  }}']").prop('selected', true);
    var department = $("#department option:selected").val();
    if ($.trim(department) != '') {
            $.ajax({
                url: '{{url("changeDepart")}}',
                type: 'POST',
                data: {departmentid: department},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(branches_data) {
                  let branches_html = "<option disabled='disabled' selected='selected'>--- Chọn Ngành ---</option>";
                     $.each(branches_data, function(index, value) {
                      branches_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                  });
                  $("#braches").html(branches_html);
                    $("#braches option[value='{{$detail->id_branch  }}']").prop('selected', true);
                    let ds = $("#braches option:selected").val();
                    $.ajax({
                        url: '{{url("changeBranches")}}',
                        type: 'POST',
                        data: {branches_change: ds},
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(dataBranches) {
                          let classes_html = "";
                    $.each(dataBranches, function(index, value) {
                        classes_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                    });
                    $("#classes").html(classes_html);
                            $("#classes option[value='{{$detail->id_classes }}']").prop('selected', true);
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









    $("#department").change(function() {
      let department_change = $(this).val();
      if ($.trim(department_change) != '') {
          $.ajax({
              url: '{{ url('changeDepart')}}',
              type: 'POST',
              data: {departmentid: department_change},
              dataType: 'JSON',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(branches_data) {
        
                  let branches_html = "<option disabled='disabled' selected='selected'>--- Chọn Ngành ---</option>";
                  $.each(branches_data, function(index, value) {
                      branches_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                  });
                  $("#braches").html(branches_html);
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
    $("#braches").change(function() {
      let branches_change = $("#braches").val();
      if (branches_change != "") {
        $.ajax({
                url: '{{ url('changeBranches')}}',
                type: 'POST',
                data: {branches_change: branches_change},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(dataBranches) {
                  console.log(dataBranches);
                    let classes_html = "";
                    $.each(dataBranches, function(index, value) {
                        classes_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                    });
                    $("#classes").html(classes_html);
                },
                error: function(err) {
                    console.log(err);
                    
                }
            });
      }
    });
 
</script>
@endsection
