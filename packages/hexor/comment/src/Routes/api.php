<?php
// 删除评论
Route::delete('/{comment_id}', 'CommentController@destroy');

// 修改评论
Route::patch('/{comment_id}', 'CommentController@update');

// 点赞评论

// 点踩评论