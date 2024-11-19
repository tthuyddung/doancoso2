<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Pug\Pug;
use Illuminate\Support\Facades\View;
use App\View\Engines\PugEngine;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $pug = new Pug();

        // Đăng ký view engine cho .pug
        $this->app['view']->addExtension('pug', 'pug', function () use ($pug) {
            return new PugEngine($pug);
        });
    
        // Đăng ký đường dẫn cho view hint 'pug'
        View::addNamespace('pug', resource_path('pug'));
    }

    
}
