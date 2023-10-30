<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\ServiceProvider;

class HomePageProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        view()->share("coursesHome", Course::where('is_popular', true)->get());
        view()->share('categoryHome', Category::where('is_active_in_home', true)->get());
    }
}
