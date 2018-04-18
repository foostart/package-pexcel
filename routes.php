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

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/pexcel', [
            'as' => 'admin_pexcel',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pexcel/edit', [
            'as' => 'admin_pexcel.edit',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/pexcel/edit', [
            'as' => 'admin_pexcel.post',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/pexcel/delete', [
            'as' => 'admin_pexcel.delete',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////




        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
         Route::get('admin/pexcel_category', [
            'as' => 'admin_pexcel_category',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pexcel_category/edit', [
            'as' => 'admin_pexcel_category.edit',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/pexcel_category/edit', [
            'as' => 'admin_pexcel_category.post',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelCategoryAdminController@post'
        ]);
         /**
         * delete
         */
        Route::get('admin/pexcel_category/delete', [
            'as' => 'admin_pexcel_category.delete',
            'uses' => 'Foostart\Pexcel\Controllers\Admin\PexcelCategoryAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});
