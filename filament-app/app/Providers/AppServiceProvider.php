<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TemplateItem;
use App\Observers\TemplateItemObserver;

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
        TemplateItem::observe(TemplateItemObserver::class);
    }
}
