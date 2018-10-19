<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder as ESClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('es', function (){
            $builder = ESClientBuilder::create()->setHosts(config('database.elasticsearch.hosts'));

            if(app()->environment() === 'local'){
                $builder->setLogger(app('log')->getMonolog());
            }

            return $builder->build();
        });
    }
}
