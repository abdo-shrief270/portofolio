<?php

namespace App\Providers;

use App\Helpers\Settings;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('settings', function () {
            return new Settings();
        });
    }

    public function boot(): void
    {
        // Share settings with all views
        View::composer('*', function ($view) {
            $view->with('settings', new class {
                public function get(string $key, mixed $default = null): mixed
                {
                    return Settings::get($key, $default);
                }
            });
        });

        // Create a Blade directive for settings
        Blade::directive('setting', function ($expression) {
            return "<?php echo \App\Helpers\Settings::get($expression); ?>";
        });
    }
}
