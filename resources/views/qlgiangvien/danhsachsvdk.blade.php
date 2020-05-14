@extends('layout')
@section('content')
<style type="text/css" media="screen">
  .trTable:hover{
    cursor: pointer;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Sinh Viên Đã Đăng Kí</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh Sách Đăng Kí</li>
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
              <div class="row">
                <div class="col-md-6">
                  <select name="status" class="form-control" style="display: none;padding-top: 5px;" id="option-status" action="{{ url('change-acceptance-dt') }}">
                       <option value="" selected="" disabled="">--Thay đổi trạng thái--</option>
                      <option value="1">Đã duyệt</option>
                    </select>
                  </div>
                <div class="col-md-6"> 
                  <button class="btn btn-danger" style="display: none;padding-top: 5px;" id="btn-del-all" data-action="">
                    <i class="fas fa-trash-alt mr-2"></i>Xóa <span></span> mục đã chọn?
                  </button>
                </div>
              </div>
            </div>
        </div>

        <div class="card-body p-4">
            <table  class="table table-bordered table-striped" id="studentTable">
              <thead>
                <tr>
                    <th class="text-center" style="background-color: #fff;width: 50px;">
                      <input type="checkbox" id="checkall"/>
                    </th>
                    <th class="text-center">Tên Đề Tài</th>
                    <th class="text-center">SV</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
              </thead>
              <tbody class="ajax-loadlist-customer">
                @foreach ($TopicProtection as $element)
                <tr class="trTable" onclick="window.location.href='{{ url('detail-kl/'.$element->id) }}'">
                   <td class="text-center"><input type="checkbox" class="checkbox" name="topics_id" value="{{$element->id}}"/></td>
                   <td>{{$element->topics->name}}</td>
                   <td>{{$element->students->name}}</td>
                   <td class="text-center">
                        @if ($element->acceptance == 1)
                           <span class="badge badge-success change_status" data-id="{{ $element->id }}">Active</span>
                        @else
                          <span class="badge badge-danger change_status" data-id="{{ $element->id }}">Unactive</span>
                        @endif
                   </td>
                </tr>
                @endforeach
              </tbody>
            </table>            
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
   <!-- DataTables -->
  <link rel="stylesheet" href="resource/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="resource/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="resource/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="resource/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="resource/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
$("#studentTable").DataTable({
            "columnDefs": [
              { "orderable": false, "targets": 0 },
              ],
            "order": [],
         });
</script>
<script type='text/javascript'>
$(document).ready(function(){
     // Check or Uncheck All checkboxes
    $("#checkall").change(function(){
       var checked = $(this).is(':checked');
       if(checked){

         $(".checkbox").each(function(){
           $(this).prop("checked",true);
         });
           $("#btn-del-all > span").html($(".checkbox:checked").length);
        $("#btn-del-all").fadeIn(300);
        $("#option-status").fadeIn(300);
       }else{
        $("#btn-del-all").hide();
         $("#option-status").hide();
         $(".checkbox").each(function(){
           $(this).prop("checked",false);
         });
       }
    });
    // Changing state of CheckAll checkbox 
    $(".checkbox").click(function(){

      if($(".checkbox").length == $(".checkbox:checked").length) {
        $("#checkall").prop("checked", true);
          
      } else {
        $("#checkall").removeAttr("checked");
      }
        if($(".checkbox:checked").length > 0){
           $("#btn-del-all > span").html($(".checkbox:checked").length);
          $("#btn-del-all").fadeIn(300);
            $("#option-status").fadeIn(300);
        } else {
          $("#btn-del-all").hide();
            $("#option-status").hide();
        }
    });
  });
   //Xóa all
  $(document).on('click', "#btn-del-all", function() {
      let action = $(this).data('action');
      let id_array = new Array();
      let chkCheckLength = $(".checkbox:checked").filter(':checked').length;
      $(".checkbox:checked").filter(':checked').each(function() {
          let id = $(this).val();
          id_array.push(id);
      });
      let idStr = id_array.join(',');
      //console.log(idStr);
      Swal({
          title: 'Xác nhận xóa?',
          type: 'error',
          html: '<p>Bạn sắp xóa ' + chkCheckLength + ' đề tài. Điều này là không thể đảo ngược.</p><p>Bạn có chắn chắn muốn xóa?</p>',
          showConfirmButton: true,
          confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
          confirmButtonColor: '#ef5350',
          cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
          showCancelButton: true,
          focusConfirm: false,
          reverseButtons: true
      }).then((result) => {
          if (result.value == true) {
              $.ajax({
                  url: action,
                  type: 'POST',
                  data: { id: idStr, length: chkCheckLength },
                  dataType: 'JSON',
                  headers: {
                      'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                  },
                  success: function(data) {
                      //console.log(data);
                      if (data.status == '_success') {
                          Swal({
                              title: data.msg,
                              showCancelButton: false,
                              showConfirmButton: false,
                              type: 'success',
                              timer: 2000
                          }).then(() => {
                              $("#btn-del-all").hide();
                              $("input[type='checkbox']").prop('checked', false);
                              $.each(id_array, function(index, value) {
                                  $("#dd-item-" + value).remove();
                                  //console.log(value);
                              });
                              if ($("#table-category .tr").length == 0) {
                                  location.reload();
                              }
                          });
                      } else {
                          Swal({
                              title: data.msg,
                              showCancelButton: false,
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                              type: 'error'
                          });
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
          return false;
      });
      return false;
  });
  //Change-all
  $(document).on('change', "#option-status", function() {
    let status = $(this).val();
      let action = $(this).attr('action');
      let id_array = new Array();
      let chkCheckLength = $(".checkbox:checked").filter(':checked').length;
      $(".checkbox:checked").filter(':checked').each(function() {
          let id = $(this).val();
          id_array.push(id);
      });
      let idStr = id_array.join(',');
      //console.log(idStr);
      Swal({
          title: 'Xác nhận xóa?',
          type: 'error',
          html: '<p>Bạn sắp thay đổi ' + chkCheckLength + ' trạng thái đề tài thành đã duyệt.</p><p>Bạn có chắn chắn muốn thay đổi?</p>',
          showConfirmButton: true,
          confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
          confirmButtonColor: '#ef5350',
          cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
          showCancelButton: true,
          focusConfirm: false,
          reverseButtons: true
      }).then((result) => {
          if (result.value == true) {
              $.ajax({
                  url: action,
                  type: 'POST',
                  data: { id: idStr, length: chkCheckLength, status: status },
                  dataType: 'JSON',
                  headers: {
                      'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                  },
                  success: function(data) {
                      console.log(data);
                      if (data.status == '_success') {
                          Swal({
                              title: data.msg,
                              showCancelButton: false,
                              showConfirmButton: false,
                              type: 'success',
                              timer: 2000
                          }).then(() => {
                              location.reload();
                          });
                      } else {
                          Swal({
                              title: data.msg,
                              showCancelButton: false,
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                              type: 'error'
                          });
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
          return false;
      });
      return false;
  });
</script>


@endsection
