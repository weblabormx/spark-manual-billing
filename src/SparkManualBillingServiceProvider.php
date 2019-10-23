<?php

namespace WeblaborMx\SparkManualBilling;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use WeblaborMx\SparkManualBilling\Console\Commands\InstallCommand;

class SparkManualBillingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'spark-manual-billing');
        $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group(['namespace' => '\WeblaborMx\SparkManualBilling\Http\Controllers', 'middleware' => ['web', 'auth', 'dev']], function () {
            Route::resource('spark/kiosk/crud/users', 'UserController');
            Route::resource('spark/kiosk/crud/teams', 'TeamController');
            Route::get('spark/kiosk/crud/teams/{team}/free-trial', 'TeamController@freeTrial');
            Route::post('spark/kiosk/crud/teams/{team}/free-trial', 'TeamController@freeTrialSave');
            Route::get('settings/teams/{team}/invoice-new/{invoice}', 'TeamController@invoice');
        });

        Blade::directive('smb_active', function ($route) {
            return "<?php if(request()->is('$route/*') || request()->is('$route')) echo 'active';?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('SPARKMB_PATH')) {
            define('SPARKMB_PATH', realpath(__DIR__.'/../'));
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class
            ]);
        }
    }
}
