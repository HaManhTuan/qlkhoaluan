@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Sửa lớp - {{$classes->name}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("ql-lop")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Sửa Lớp</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body p-5 col-md-12">
           <form action="{{ url('postupdateqllop') }}" method="POST" id="frm-add">
               @csrf
               <input type="hidden" name="id" value="{{$classes->id}}">
               <div class="row">
                 <div class="form-group col-md-6">
                    <label for="department">Tên Khoa</label>
                    <select name="department_id" class="form-control" id="department">
                       <option value="" disabled="disabled" selected="selected">--- Chọn Khoa ---</option>
                       {!!$data_depart_select!!}
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="branches_id">Tên Ngành</label>
                    <select name="branches_id" class="form-control" id="braches">
                        <option value="" disabled="disabled" selected="selected">--- Chọn Ngành ---</option>
                        {!!$data_branches_select!!}
                    </select>
                </div>
               </div>
                
                <div class="form-group col-md-6">
                    <label for="department">Tên Lớp</label>
                    <input type="text" class="form-control" id="classes" name="classes" placeholder="Hãy nhập tên lớp" data-rule-required="true" data-msg-required="Vui lòng nhập tên lớp." value="{{$classes->name}}">
                </div>
                <button type="submit" class="btn btn-primary btn-save">Lưu</button>
           </form>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<script>
     const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
// Change
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
                console.log(branches_data);
                  let branches_html = "";
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
</script>
@endsection
