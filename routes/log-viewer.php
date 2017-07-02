<?php


Route::get('/', 'LogViewerController@index')->name('dashboard');

Route::prefix('logs')->name('logs.')->group(function() {
    Route::get('/', 'LogViewerController'.'@listLogs')
        ->name('list'); // log-viewer::logs.list

    Route::delete('delete', 'LogViewerController'.'@delete')
        ->name('delete'); // log-viewer::logs.delete

    Route::prefix('{date}')->group(function() {
        Route::get('/', 'LogViewerController'.'@show')
            ->name('show'); // log-viewer::logs.show

        Route::get('download', 'LogViewerController'.'@download')
            ->name('download'); // log-viewer::logs.download

        Route::get('{level}', 'LogViewerController'.'@showByLevel')
            ->name('filter'); // log-viewer::logs.filter
    });
});