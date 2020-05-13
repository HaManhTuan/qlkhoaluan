<?php
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'LecturersController@pagenotfound']);
Route::get('lecturers/login', 'LecturersController@login');
Route::post('lecturers/dang-nhap', 'LecturersController@dangnhap');
Route::group(['prefix' => 'lecturers', 'middleware' => 'Lecturers'], function () {
  Route::get('dashboard', 'DashboardController@index');
  //Topic
  Route::group(['prefix' => 'topic', 'middleware' => 'Lecturers'], function () {
        Route::get('view-topic', 'TopicController@view');
        Route::post('add-topic', 'TopicController@add');
        Route::post('edit-modal', 'TopicController@editModal');
        Route::post('edit-topic', 'TopicController@edit');
        Route::post('delete', 'TopicController@delete');
    });
});
?>