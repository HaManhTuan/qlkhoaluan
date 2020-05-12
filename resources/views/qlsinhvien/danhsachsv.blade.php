@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Quản Lý Sinh Viên</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trở Về</a></li>
              <li class="breadcrumb-item active">Danh Sách Sinh Viên</li>
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
          <div class="card-title">
              
           <form class="form-inline ml-3">
           <div class="input-group input-group-sm">
           <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
           <div class="input-group-append">
           <button type="button" class="btn btn-primary btn-large btn-ssup"
                  onclick="cms_paging_supplier(1)"><i class="fa fa-search"></i> Tìm kiếm
           </button>
           </div>
           </div>
           </form>

           </div>

          <div class="card-tools">
            <div class="btn-groups">
                 <button type="button" class="btn btn-primary" data-toggle="modal"
                         data-target="#create-cust"><i class="fa fa-plus-circle"></i> Thêm Sinh viên
                 </button>
                 <button type="button" class="btn btn-success" onclick=""><i class="fa fa-download"></i> Xuất Excel</button>
            </div>
          </div>

        </div>

        <div class="card-body p-0">
          <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Mã Sinh Viên</th>
                            <th class="text-center">Tên Sinh Viên</th>
                            <th class="text-center">Khoa</th>
                            <th class="text-center">Ngành</th>
                            <th class="text-center">Lớp</th>
                            <th class="text-center">Địa Chỉ</th>
                            <th class="text-center" style="background-color: #fff;">Action</th>
                        </tr>
                        </thead>
                        <tbody class="ajax-loadlist-customer">
                        <?php if (isset($_list_customer) && count($_list_customer)) :
                            foreach ($_list_customer as $key => $item) :
                                ?>
                                <tr id="tr-item-<?php echo $item['ID']; ?>">
                                    <td onclick="cms_detail_customer(<?php echo $item['ID']; ?>)" class="text-center tr-detail-item"
                                        style="cursor: pointer; color: #1b6aaa;"><?php echo $item['customer_code']; ?></td>
                                    <td onclick="cms_detail_customer(<?php echo $item['ID']; ?>)" class="text-center tr-detail-item"
                                        style="cursor: pointer; color: #1b6aaa;"><?php echo $item['customer_name']; ?></td>
                                    <td class="text-center"><?php echo (!empty($item['customer_phone'])) ? $item['customer_phone'] :
                                            '-'; ?></td>
                                    <td class="text-center"><?php echo (!empty($item['customer_addr'])) ? $item['customer_addr'] :
                                            '-'; ?></td>
                                    <td class="text-center"><?php echo (!empty($item['sell_date'])) ? $item['sell_date'] :
                                            '-'; ?></td>
                                    <td class="text-right"
                                        style="font-weight: bold; background-color: #f9f9f9;"><?php echo (!empty($item['total_money'])) ? number_format($item['total_money']) :
                                            '-'; ?></td>
                                    <td class="text-right"><?php echo (!empty($item['total_debt'])) ? number_format($item['total_debt']) :
                                            '-'; ?></td>
                                    <td class="text-center"><i class="fa fa-trash-o" style="cursor:pointer;"
                                                               onclick="cms_delCustomer(<?php echo $item['ID']; ?>,1);"></i>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>

                    </table>
                 
                 <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


@endsection
