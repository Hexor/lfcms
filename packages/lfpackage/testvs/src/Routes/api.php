<?php

Route::get('/testapi', function (Request $request) {
    return response()->json([
        'status' => 1,
        'msg' => '',
        'data' => null
    ]);
});
