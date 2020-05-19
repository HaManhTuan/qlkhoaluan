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
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Hội Đồng {{$name_council->name_council}}</h4>
            <h6> {{$name_council->protect->name}}</h6>
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
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $stt = 1;
                    @endphp
                    @foreach ($StudentCouncil as $element)
                     <tr>
                      <td>{{ $stt++}}</td>
                      <td>{{ $element->msv}}</td>
                      <td>{{ $element->name}}</td>
                      <td>
                        @php
                          $student = DB::table('students')->where('msv',$element->msv)->first();
                          $classes = DB::table('classes')->where('id',$student->id_classes)->value('name');
                          echo $classes;
                        @endphp
                      </td>
                      <td>{{ $element->topic}}</td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
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

