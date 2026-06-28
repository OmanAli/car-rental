<?php

namespace App\Providers;

use App\Models\Car;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('frontend.*', function ($view) {
            if (Schema::hasTable('cars')) {
                $view->with('rentModalCars', Car::with('carType')->where('status', 1)->get());
            } else {
                $view->with('rentModalCars', collect());
            }
        });
    }
}
