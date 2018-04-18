<?php

namespace Foostart\Pexcel;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class PexcelServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/pexcel_admin.php' => config_path('pexcel_admin.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'pexcel');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'pexcel');


        /**
         * Load view composer
         */
        $this->pexcelViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Foostart\Pexcel\Controllers\Admin\PexcelAdminController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'pexcel');
    }

    /**
     *
     */
    public function pexcelViewComposer(Request $request) {

        view()->composer('pexcel::pexcel*', function ($view) {
            global $request;
            $pexcel_id = $request->get('id');
            $is_action = empty($pexcel_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * Pexcels
                 */
                //list
                trans('pexcel::pexcel_admin.page_list') => [
                    'url' => URL::route('admin_pexcel'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
                //add
                trans('pexcel::pexcel_admin.'.$is_action) => [
                    'url' => URL::route('admin_pexcel.edit'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],

                /**
                 * Categories
                 */
                //list
                trans('pexcel::pexcel_admin.page_category_list') => [
                    'url' => URL::route('admin_pexcel_category'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
            ]);
            //
        });
    }

}
