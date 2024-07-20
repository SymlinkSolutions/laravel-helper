<?php

namespace Symlink\LaravelHelper;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Symlink\LaravelHelper\Console\InstallSymlinkPackage;
use Symlink\LaravelHelper\View\Components\Notification;
use Illuminate\Contracts\Http\Kernel;

/**
 * Examples and Guidence from
 * https://www.laravelpackage.com
 * 
 */

class SymlinkLaravelHelperServiceProvider extends ServiceProvider {
    // ----------------------------------------------------------------------------------------------------
    // Properties
    // ----------------------------------------------------------------------------------------------------
    protected $root = __DIR__.'/..';
    // ----------------------------------------------------------------------------------------------------
    // Functions
    // ----------------------------------------------------------------------------------------------------
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom("{$this->root}/config/symlinkLaravelHelper.php", 'laravel-helper');
        // $this->app->register(EventServiceProvider::class);
    }
    // ----------------------------------------------------------------------------------------------------
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel) {
        $this->loadMigrationsFrom("{$this->root}/database/migrations");
        $this->loadViewsFrom("{$this->root}/resources/views", 'symlink');
        if ($this->app->runningInConsole()) {
            $this->loadCommands();
            $this->loadPublishes();
        }
        $this->registerRoutes();

        // $kernel->pushMiddleware(CapitalizeTitle::class);
    }
    // ----------------------------------------------------------------------------------------------------
    // Other Functions
    // ----------------------------------------------------------------------------------------------------
    protected function loadCommands() {
        $this->commands([
            InstallSymlinkPackage::class,
        ]);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function loadPublishes() {
        $this->publishes([
            "{$this->root}/config/symlinkLaravelHelper.php" => config_path('symlinkLaravelHelper.php'),
        ], 'config');

        $this->publishes([
            "{$this->root}/src/View/Components/Notification.php" => app_path('View/Components/Notification.php'),
            "{$this->root}/resources/views/components/notification.blade.php" => resource_path('views/components/notification.blade.php'),
        ], 'notification');
    }
    // ----------------------------------------------------------------------------------------------------
    protected function loadComponents() {
        $this->loadViewComponentsAs('symlink', [
            Notification::class
        ]);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function registerRoutes() {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom("{$this->root}/routes/developer.php");
        });

        $this->loadRoutesFrom("{$this->root}/routes/auth.php");
    }
    // ----------------------------------------------------------------------------------------------------
    protected function routeConfiguration() {
        return [
            'prefix' => config('symlink.developer'),
            // 'middleware' => config('.middleware'),
        ];
    }
    // ----------------------------------------------------------------------------------------------------
}
