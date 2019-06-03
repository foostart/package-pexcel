<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('pexcel', [
    'as' => 'pexcel',
    'uses' => 'Foostart\Pexcel\Controllers\Front\PexcelFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Pexcel\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage pexcel
          |-----------------------------------------------------------------------
          | 1. List of pexcels
          | 2. Edit pexcel
          | 3. Delete pexcel
          | 4. Add new pexcel
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
         Route::get('admin/pexcels', [
            'as' => 'pexcels.list',
            'uses' => 'PexcelAdminController@index'
        ]);
        Route::get('admin/pexcels/list', [
            'as' => 'pexcels.list',
            'uses' => 'PexcelAdminController@index'
        ]);

        /**
         * view
         */
        Route::get('admin/pexcels/view', [
            'as' => 'pexcels.view',
            'uses' => 'PexcelAdminController@view'
        ]);

        /**
         * download
         */
        Route::get('admin/pexcels/download', [
            'as' => 'pexcels.download',
            'uses' => 'PexcelAdminController@download'
        ]);

        /**
         * save
         */
        Route::post('admin/pexcels/save', [
            'as' => 'pexcels.save',
            'uses' => 'PexcelAdminController@save'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pexcels/edit', [
            'as' => 'pexcels.edit',
            'uses' => 'PexcelAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/pexcels/copy', [
            'as' => 'pexcels.copy',
            'uses' => 'PexcelAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/pexcels/edit', [
            'as' => 'pexcels.post',
            'uses' => 'PexcelAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/pexcels/delete', [
            'as' => 'pexcels.delete',
            'uses' => 'PexcelAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/pexcels/trash', [
            'as' => 'pexcels.trash',
            'uses' => 'PexcelAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/pexcels/config', [
            'as' => 'pexcels.config',
            'uses' => 'PexcelAdminController@config'
        ]);

        Route::post('admin/pexcels/config', [
            'as' => 'pexcels.config',
            'uses' => 'PexcelAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/pexcels/lang', [
            'as' => 'pexcels.lang',
            'uses' => 'PexcelAdminController@lang'
        ]);

        Route::post('admin/pexcels/lang', [
            'as' => 'pexcels.lang',
            'uses' => 'PexcelAdminController@lang'
        ]);

    });
});
