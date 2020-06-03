@extends('layout')
@section('content')
<style>
  #exampleInputFile-error{
    position: absolute;
    top: 50px;
  }
</style>
  <!-- Select2 -->
  <link rel="stylesheet" href="resource/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="resource/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Hội Đồng {{$name_council->name_council}}</h4>
            <h6> {{$name_council->protect->name}}</h6>
            <p>Thời gian bắt đầu: {{$name_council->protect->time_start}} </p> 
            <p>Thời gian kết thúc: {{$name_council->protect->time_end}}</p>
            <p>Trạng thái: 
              @php
                $now = date("Y-m-d");
              @endphp
              @if ($now < $name_council->protect->time_end)
                <span class="badge badge-success"> Chưa bảo vệ</span>
              @else
               <span class="badge badge-danger"> Đã bảo vệ</span>
              @endif
            </p>
          </div>

        </div>
      </div>
    </section>
    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
              <button class="btn btn-danger btn-del"  data-council="{{$id_council}}">
                    <i class="fas fa-trash-alt mr-2"></i>Xóa dữ liệu
              </button>
              @if ($now == $name_council->protect->time_end || $now > $name_council->protect->time_end)
              <form action="{{ url('council/add-points') }}" method="POST" id="frm-points" style="display: inline-block;">
                @csrf
                <input type="hidden" name="id_council" value="{{$id_council}}">
                <button class="btn btn-primary" type="submit" data-council="{{$id_council}}">
                    <i class="fas fa-plus mr-2"></i>Nhập điểm
              </button>
              @endif
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row">
              <div class="col-md-3">
                @foreach ($lecturer as $element)
                  <p>
                    @if ($element->position == 1)
                      <span class="font-weight-bold">Trưởng ban</span>
                    @elseif ($element->position == 2)
                    <span class="font-weight-bold">Thư kí</span>
                    @elseif ($element->position == 3 || $element->position == 4 || $element->position == 5)
                    <span class="font-weight-bold">Ủy viên</span>
                    @endif
                    : {{ $element->lecturer->name_lecturer }} </p>
                @endforeach
               
              </div>
              <div class="col-md-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>MSV </th>
                      <th>Tên </th>
                      <th>Lớp</th>
                      <th>Đề tài</th>
                      <th>Điểm</th>
                      <th>TT</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $stt = 1;
                    @endphp
                    @foreach ($StudentCouncil as $element)
                     <tr>
                      <td>{{ $stt++}}</td>
                      <td>{{ $element->msv}}
                        <input type="hidden" name="msv[]" value="{{ $element->msv}}"></td>
                      <td>{{ $element->name}}</td>
                      <td>
                        @php
                          $student = DB::table('students')->where('msv',$element->msv)->first();
                          $classes = DB::table('classes')->where('id',$student->id_classes)->value('name');
                          echo $classes;
                        @endphp
                      </td>
                      <td>{{ $element->topic}}</td>
                      <td>
                        <input type="text" name="score[]" class="form-control" value="{{ $element->score}}" style="width: 50px;">
                      </td>
                      <td>
                        @if ( $element->pass == 1)
                           <span class="badge badge-success">Qua</span>
                        @else
                        @if ($element->pass == "")
                          <span class="badge badge-default">None</span>
                        @else
                         <span class="badge badge-danger">Trượt</span>
                        @endif
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </form>
              </div>
            </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    const Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000
    });
    $(".btn-del").on('click',function() {
      let id = $(this).attr('data-council');
      Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp xóa 1 .</p><p>Bạn có chắn chắn muốn xóa?</p>',
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
            url: '{{ url('council/delete-council') }}',
            type: 'POST',
            data: {id_council: id},
            dataType: 'JSON',
            headers: {
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            success: function(data) {
                            //console.log(data);
                            if(data.status == '_success') {
                              Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
                              }).then(() => {
                                window.location.href="{{ url('qlhoidong') }}";
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

