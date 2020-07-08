@extends('layout')
@section('content')
<style>
  #ds_protect{
    display: none;
  }
</style>
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
            <h4>Quản Lý Hội Đồng</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("ql-hoidong")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh sách hội đồng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">

          <div class="card-tools">
            <div class="btn-groups">
                 <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('council/add') }}'"><i class="fa fa-plus-circle"></i> Thêm Hội Đồng
                 </button>
                <!--  <button type="button" class="btn btn-success" onclick=""><i class="fa fa-download"></i> Xuất Excel</button> -->
            </div>
          </div>

        </div>

        <div class="card-body p-2">
          
            <form action="" method="POST">
              <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Đợt bảo vệ đồ án</label>
                    <select name="id_protect" class="form-control" id="id_protect">
                      <option value="" selected="" disabled="">-- Chọn đợt bảo vệ --</option>
                      @foreach ($Protections as $element)
                        <option value="{{$element->id}}">{{$element->name}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="ds_protect">
                  
                </div>
              </div>
               </div>
            </form>
         
        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<script>
  $("#id_protect").change(function(){
    let id_protect = $(this).val();
    $.ajax({
      url: '{{ url('council/change-protect') }}',
      type: 'POST',
      dataType: 'JSON',
      data: {id_protect: id_protect},
      headers:{
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
      },
      success: function(data){
        console.log(data);
        $("#ds_protect").html(data);
        $("#ds_protect").show();
      },
      error: function(err){
        console.log(err);
      }
    });

  })
</script>


@endsection

