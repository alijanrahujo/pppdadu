<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share site settings globally with views
        View::composer('*', function ($view) {
            static $siteSettings = null;

            if ($siteSettings === null) {
                try {
                    if (Schema::hasTable('site_settings')) {
                        $siteSettings = SiteSetting::query()
                            ->whereIn('group', ['general', 'social'])
                            ->pluck('value', 'key')
                            ->toArray();
                    } else {
                        $siteSettings = [];
                    }
                } catch (\Throwable) {
                    $siteSettings = [];
                }
            }

            $view->with('siteSettings', $siteSettings);
        });
    }
}
