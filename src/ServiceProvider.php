<?php


namespace Nichozuo\LaravelCommon;



class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
//    protected $defer = false;

    public function register()
    {
        $this->commands([
        ]);
    }

    public function boot()
    {
//        $this->publishes([
//            __DIR__ . '/resources/laravel-doc-react/dist' => public_path('docs'),
//            __DIR__ . '/resources/config/codegen.php' => config_path('codegen.php')
//        ]);
//        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
    }
}