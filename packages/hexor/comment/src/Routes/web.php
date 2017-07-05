<?php

// 返回target 相关评论
Route::get('/{target_id}', 'CommentController@index');

// 新建评论
Route::post('/{target_id}', [
    'as' => 'comments.store',
    'uses' => 'CommentController@store'
]);
