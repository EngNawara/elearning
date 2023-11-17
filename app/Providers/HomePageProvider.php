<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Slider;
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
        // //
        view()->share("coursesHome", Course::where('is_popular', true)->get());
        view()->share("bestCoursesHome", Course::where('is_best', true)->get());
        view()->share("homeSliders", Slider::where('status', 'enabled')->get());
        view()->share('categoryHome', Category::where('is_active_in_home', true)->get());
    }
}
