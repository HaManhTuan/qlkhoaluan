<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login
Route::get('login',[
      'as'=>'lo-gin',
      'uses'=>'LoginController@getLogin'
]);
Route::post('postlogin','LoginController@postLogin');
//Dang-ki-giao-vien
Route::get('register-teacher','LoginController@register');
Route::post('register-post','LoginController@registerpost');


Route::group(['middleware' => 'Admin'], function () {


 Route::get('council/add', 'Admin\ProtectLecturerController@add');
 Route::get('council/export', 'Admin\ProtectLecturerController@export');
 Route::post('council/add-post', 'Admin\ProtectLecturerController@addPost');
 Route::get('council/edit/{id}', 'Admin\ProtectLecturerController@edit');
 Route::post('council/edit', 'Admin\ProtectLecturerController@editPost');
 Route::post('council/delete', 'Admin\ProtectLecturerController@delete');
 Route::post('council/change-protect','QlhoidongController@chaneProtect');
 Route::post('council/delete-council','QlhoidongController@delete');
 Route::get('council/detail/{id_council}','QlhoidongController@detail');
 Route::post('council/add-points','QlhoidongController@points');
 Route::get('council/export-pro/{id}', 'Admin\ProtectLecturerController@exportPro');
 
Route::get('dang-xuat','LoginController@logout')->name("dang-xuat");
Route::get('/','PageController@getIndex')->name("trang-chu");
//Permissions
    Route::get('user/permissions', 'PermissionsController@index');
    Route::get('user/add-permissions', 'PermissionsController@add');
    Route::post('user/add-post-permissions', 'PermissionsController@postadd');
    Route::get('user/edit-permissions/{id}', 'PermissionsController@edit');
    Route::post('user/edit-post-permissions', 'PermissionsController@postedit');
    Route::post('user/del-post-permissions', 'PermissionsController@delete');
//Roles
    Route::get('user/roles', 'RolesController@index');
    Route::get('user/add-roles', 'RolesController@add');
    Route::post('user/add-post-roles', 'RolesController@postadd');
    Route::get('user/edit-roles/{id}', 'RolesController@edit');
    Route::post('user/edit-post-roles', 'RolesController@postedit');
    Route::post('user/del-post-roles', 'RolesController@delete');
//qlhoidong
Route::get('qlhoidong',[
      'as'=>'ql-hoidong',
      'uses'=>'QlhoidongController@getQlhoidong'
]);


//qlkhoaluan
Route::get('qlkhoaluan',[
      'as'=>'ql-khoaluan',
      'uses'=>'QlkhoaluanController@getQlkhoaluan'
]);
Route::get('detail-kl/{id}','QlkhoaluanController@detailkl');
//Change-status-detaial
Route::post('change-detail-kl','QlkhoaluanController@changedetailkl');
Route::get('dangkidt',[
      'as'=>'dangki-dt',
      'uses'=>'QlkhoaluanController@getDangkidt'
]);

//qlsinhvien
Route::get('qlsinhvien',[
      'as'=>'ql-sinhvien',
      'uses'=>'QlsinhvienController@getQlsinhvien'
]);
Route::post('import-sv','QlsinhvienController@import');
Route::get('add-sv','QlsinhvienController@add');
Route::post('changeBranches','QlsinhvienController@changebrand');
Route::post('addPost','QlsinhvienController@store');
Route::get('edit-sv/{id}','QlsinhvienController@edit');
Route::post('updateSV','QlsinhvienController@update');
Route::post('delete-sv','QlsinhvienController@delete');
//qlgiangvien
Route::get('qlgiangvien',[
      'as'=>'ql-giangvien',
      'uses'=>'QlgiangvienController@getQlgiangvien'
]);
Route::post('delete-lecturer-admin',[
      'as'=>'del-ql-giangvien',
      'uses'=>'QlgiangvienController@deleteLecturerAdmin'
]);

Route::post('import-gv','QlgiangvienController@import');
Route::post('change-accept','QlgiangvienController@changeaccept');
Route::post('delete-topic','QlgiangvienController@deletetopic');
//Xem chi tidy_error_count(object)
Route::get('chi-tiet-gv/{id}','QlgiangvienController@detaillectures');
Route::post('editTopic','QlgiangvienController@editTopic');
Route::post('editTopicPost','QlgiangvienController@editTopicPost');
Route::post('delete-topic-post','QlgiangvienController@deleteTopicPost');

//Change-status-gv
Route::post('change-status','QlgiangvienController@changestatus');
Route::post('change-acceptance-dt','QlgiangvienController@changeacceptancedt');
Route::get('danhsachsvdk',[
      'as'=>'danhsach-svdk',
      'uses'=>'QlgiangvienController@getDanhsachsvdk'
]);

Route::get('detaigv',[
      'as'=>'detai-gv',
      'uses'=>'QlgiangvienController@getDetaigv'
]);
//Change-status-dtgv
Route::post('change-dtgv-status','QlgiangvienController@changedtstatus');
//Delete-dtgv
Route::post('import-nganhang','QlgiangvienController@importnganhang');
Route::post('delete-dtgv-all','QlgiangvienController@deletedtgvall');
Route::get('detail-dt-gv/{id}','QlgiangvienController@detaildtgv');









//qllinhvuc

//LINHVUC
Route::get('ql-linhvuc','QllinhvucController@Qllv')->name('ql-linhvuc');
Route::post('postqllinhvuc','QllinhvucController@postqllinhvuc');
Route::post('post-modal-field','QllinhvucController@postmodalfield');
Route::post('postupdateqllinhvuc','QllinhvucController@postupdateqllinhvuc');
Route::post('delete-fields','QllinhvucController@deletefields');

//Khoa
Route::get('qlkhoa',[
      'as'=>'ql-khoa',
      'uses'=>'QllinhvucController@getQlkhoa'
]);
Route::post('post-modal-depart','QllinhvucController@postmodalQlkhoa');
Route::post('postupdateqlkhoa','QllinhvucController@postupdateQlkhoa');
Route::post('postqlkhoa','QllinhvucController@postQlkhoa');
Route::post('delete-depart','QllinhvucController@deletedepart');



//Ngành
Route::get('qlnganh',[
      'as'=>'ql-nganh',
      'uses'=>'QllinhvucController@getQlnganh'
]);
//Add
Route::post('postqlnganh','QllinhvucController@postqlnganh');
//Modal
Route::post('post-modal-branches','QllinhvucController@postmodalQlnganh');
//Edit
Route::post('postupdateqlnganh','QllinhvucController@postupdateQlnganh');
//Delete
Route::post('delete-branches','QllinhvucController@deletebranches');


//Lớp
Route::get('qllop',[
      'as'=>'ql-lop',
      'uses'=>'QllinhvucController@getQllop'
]);
//Add
Route::post('postqllop','QllinhvucController@postqllop');
//formEdit
Route::get('edit-classes/{id}','QllinhvucController@loadFormEdit');
//Edit
Route::post('postupdateqllop','QllinhvucController@postupdateQllop');
//Delete
Route::post('delete-classes','QllinhvucController@deleteclasses');
//changeDepart
Route::post('changeDepart','QllinhvucController@changeDepart');

//User
Route::get('add-user','UserController@add');
Route::post('add-post-user','UserController@postadd');
Route::get('edit-user/{id}','UserController@edit');
Route::post('edit-post-user','UserController@postedit');
Route::post('del-post-user','UserController@deleteuser');

//qldoibaove
Route::get('danhsachdbv',[
      'as'=>'danhsach-dbv',
      'uses'=>'QldotbaoveController@getQldotbaove'
]);
Route::get('add-protection','QldotbaoveController@add');
Route::get('edit-protection/{id}','QldotbaoveController@edit');
Route::post('edit-post-protections','QldotbaoveController@editpost');
Route::post('add-post-protections','QldotbaoveController@addpost');
Route::post('change-status-hd','QldotbaoveController@changestatushd');
Route::post('departmenr/delete','QldotbaoveController@delete');

//taikhoan

Route::get('taikhoan',[
      'as'=>'tai-khoan',
      'uses'=>'TaikhoanController@getTaikhoan'
]);





});
