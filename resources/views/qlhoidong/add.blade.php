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
            <h4>Thêm Hội Đồng</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("ql-hoidong")}}">Trở Về</a></li>
              <li class="breadcrumb-item active">Thêm hội đồng</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="card">
        <div class="card-body p-4">
          <form action="{{ url('council/add-post') }}" method="POST" enctype="multipart/form-data" id="frm-add-council">
              @csrf
              <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="name" class="form-label">Tên hội đồng</label>
                      <input type="number" class="col-md-7 form-control" id="name" name="name" data-rule-required="true"
                          data-msg-required="Hãy nhập tên hội đồng.">
                  </div>
                  <div class="form-group">
                      <label for="id_protect" class="form-label">Đợt bảo vệ</label>
                       <select name="id_protect" class="form-control" id="id_protect" data-rule-required="true"
                          data-msg-required="Hãy chọn đợt bảo vệ.">
                         <option value="" selected="" disabled="">-- Chọn đợt bảo vệ --</option>
                         @foreach ($protect as $element)
                           <option value="{{$element->id}}">{{$element->name}}</option>
                         @endforeach
                       </select>
                  </div>
                  <div class="form-group">
                     <label for="id_protect" class="form-label">Import sinh viên</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="select_file"
                        data-rule-required="true"
                          data-msg-required="Hãy nhập file Excel.">
                        <label class="custom-file-label" for="exampleInputFile">Import sinh viên</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Import</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                 
                  <div class="form-group">
                      <label for="name" class="form-label">Trưởng ban</label>
                      <input type="hidden" name="postion[]" value="1">
                      <div class="select2-purple">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn trưởng ban" data-dropdown-css-class="select2-purple" style="width: 100%;" name="id_lecturer[]">
                           @foreach ($lecturer as $element)
                            <option value="{{$element->id}}">{{$element->name_lecturer}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="name" class="form-label">Thư kí</label>
                      <input type="hidden" name="postion[]" value="2">
                      <div class="select2-purple">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn trưởng ban" data-dropdown-css-class="select2-purple" style="width: 100%;" name="id_lecturer[]">
                           @foreach ($lecturer as $element)
                            <option value="{{$element->id}}">{{$element->name_lecturer}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="name" class="form-label">Uỷ viên 1</label>
                      <input type="hidden" name="postion[]" value="3">
                      <div class="select2-purple">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn trưởng ban" data-dropdown-css-class="select2-purple" style="width: 100%;" name="id_lecturer[]">
                           @foreach ($lecturer as $element)
                            <option value="{{$element->id}}">{{$element->name_lecturer}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="name" class="form-label">Uỷ viên 2</label>
                      <input type="hidden" name="postion[]" value="4">
                      <div class="select2-purple">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn trưởng ban" data-dropdown-css-class="select2-purple" style="width: 100%;" name="id_lecturer[]">
                           @foreach ($lecturer as $element)
                            <option value="{{$element->id}}">{{$element->name_lecturer}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="name" class="form-label">Uỷ viên 3</label>
                      <input type="hidden" name="postion[]" value="5">
                      <div class="select2-purple">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn trưởng ban" data-dropdown-css-class="select2-purple" style="width: 100%;" name="id_lecturer[]">
                           @foreach ($lecturer as $element)
                            <option value="{{$element->id}}">{{$element->name_lecturer}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
{{--                   <div class="form-inline">
                    <div class="field_wrapper_size">
                      <input type="text" name="id_lecturer[]"  id="id_lecturer"  class="form-control" placeholder="Hãy nhập tên giáo viên" style="width: 300px;"  data-rule-required="true"
                          data-msg-required="Hãy nhập tên.">
                      <input type="text" name="position[]"  id="position"  class="form-control" placeholder="Vị trí" style="width: 100px;"  data-rule-required="true"
                          data-msg-required="Hãy nhập vị trí.">
                      <a href="javascript:void(0);" class="btn btn-primary add_button_size"><i class="fas fa-plus"></i></a>
                    </div>
                  </div> --}}
                </div>
              </div>  
              <div class="form-group">
                  <button class="btn btn-primary" type="submit">Lưu</button>
              </div>
           </form>
        </div>
      </div>
    </section>
  </div>
  <script src="resource/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    $('.select2').select2();
  });
</script>
      <script>
        $(document).ready(function() {
        let maxField = 10;
        let addButton = $('.add_button_size');
        let wrapper = $('.field_wrapper_size');
        let fieldHTML='<div class="field_wrapper_add_color" style="margin-top:2px;"><input type="text" name="id_lecturer[]"  id="id_lecturer"  class="form-control" placeholder="Hãy nhập tên giáo viên" style="width: 300px;"><input type="text" name="position[]"  id="position"  class="form-control ml-1" placeholder="Vị trí" style="width: 100px;"><a href="javascript:void(0);" class="btn btn-danger remove_button_color" style="margin-left:3px;"><i class="fas fa-trash"></i></a></div>';
        let x =1;
        $(addButton).click(function(){
          if(x < maxField){
            x++;
            $(wrapper).append(fieldHTML);
          }
        });
        $(wrapper).on('click','.remove_button_color', function(e){
          e.preventDefault();
          $(this).parent('div .field_wrapper_add_color').remove();
          x--;
        });
        $("#frm-add-council").validate();
         
      });
    </script>
@endsection

