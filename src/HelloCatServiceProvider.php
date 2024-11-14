<?php

namespace Naymyomhan\HelloCat;

use Illuminate\Support\ServiceProvider;

class HelloCatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //public a config file
        $this->publishes([
            __DIR__ . '/../config/cat.php' => config_path('cat.php'),
        ], 'hello-cat');

        //run php artisan vendor:publish --tag=hello-cat to publish config file
    }

    public function register()
    {
        $this->app->singleton(Cat::class, function () {
            return new Cat();
        });
        $this->app->singleton(CatGroup::class, function () {
            return new CatGroup();
        });
    }
}
