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

Route::get('/', function () {
    return view('welcome');
});
//login
Route::get('login',[
      'as'=>'lo-gin',
      'uses'=>'LoginController@getLogin'
]);
Route::post('postlogin','LoginController@postLogin');

Route::group(['middleware' => 'Admin'], function () {
      Route::get('dang-xuat','LoginController@logout')->name("dang-xuat");
      Route::get('index','PageController@getIndex')->name("trang-chu");

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

Route::get('dangkidt',[
      'as'=>'dangki-dt',
      'uses'=>'QlkhoaluanController@getDangkidt'
]);

//qlsinhvien
Route::get('qlsinhvien',[
      'as'=>'ql-sinhvien',
      'uses'=>'QlsinhvienController@getQlsinhvien'
]);

//qlgiangvien
Route::get('qlgiangvien',[
      'as'=>'ql-giangvien',
      'uses'=>'QlgiangvienController@getQlgiangvien'
]);

Route::get('danhsachsvdk',[
      'as'=>'danhsach-svdk',
      'uses'=>'QlgiangvienController@getDanhsachsvdk'
]);

Route::get('detaigv',[
      'as'=>'detai-gv',
      'uses'=>'QlgiangvienController@getDetaigv'
]);

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






//qldoibaove
Route::get('danhsachdbv',[
      'as'=>'danhsach-dbv',
      'uses'=>'QldotbaoveController@getQldotbaove'
]);

//taikhoan

Route::get('taikhoan',[
      'as'=>'tai-khoan',
      'uses'=>'TaikhoanController@getTaikhoan'
]);


});
