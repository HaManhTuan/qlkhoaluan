<?php
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'StudentsController@pagenotfound']);
Route::get('students/login', 'StudentsController@login');
Route::post('students/dang-nhap', 'StudentsController@dangnhap');
Route::group(['prefix' => 'students', 'middleware' => 'Students'], function () {
  Route::get('dashboard', 'DashboardController@index');
  Route::get('register-topic', 'StudentsController@registerTopics');
  Route::post('change-register-fields', 'StudentsController@changeregisterfields');
  Route::post('register-post-topic', 'StudentsController@registerpostTopics');
});
?>