<?php


namespace Nichozuo\LaravelCommon;


use Nichozuo\LaravelCommon\DevTools\Commands\ClearDBCacheCommand;
use Nichozuo\LaravelCommon\DevTools\Commands\DumpTableCommand;
use Nichozuo\LaravelCommon\DevTools\Commands\GenFilesCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->commands([
            DumpTableCommand::class,
            ClearDBCacheCommand::class,
            GenFilesCommand::class
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/resources/laravel-common/dist' => public_path('docs'),
            __DIR__ . '/config/common.php' => config_path('common.php')
        ]);
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
    }
}