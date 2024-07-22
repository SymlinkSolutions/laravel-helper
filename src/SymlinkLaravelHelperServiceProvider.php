<?php

namespace Symlink\LaravelHelper;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Symlink\LaravelHelper\Console\InstallSymlinkPackage;
use Symlink\LaravelHelper\View\Components\Notification;
use Illuminate\Contracts\Http\Kernel;
use Symlink\LaravelHelper\Console\ResourceSetup;
use Symlink\LaravelHelper\View\Components\Layouts\GuestLayout;

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
        $this->loadPublishes();
        $this->loadMigrationsFrom("{$this->root}/database/migrations");
        $this->loadViewsFrom("{$this->root}/resources/views", 'symlink');
        if ($this->app->runningInConsole()) {
            $this->loadCommands();
        }
        $this->registerRoutes();
        $this->loadComponents();

        // $kernel->pushMiddleware(CapitalizeTitle::class);
    }
    // ----------------------------------------------------------------------------------------------------
    // Other Functions
    // ----------------------------------------------------------------------------------------------------
    protected function loadCommands() {
        $this->commands([
            InstallSymlinkPackage::class,
            ResourceSetup::class,
        ]);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function loadPublishes() {
        $this->publishes([
            "{$this->root}/config/symlinkLaravelHelper.php" => config_path('symlinkLaravelHelper.php'),
        ], "symlink-config");

        // TODO notification publish needs adjustment
        $this->publishes([
            "{$this->root}/src/View/Components/Notification.php" => app_path('View/Components/Notification.php'),
            "{$this->root}/resources/views/components/notification.blade.php" => resource_path('views/components/notification.blade.php'),
        ], "symlink-notification");

        $this->publishes([
            "{$this->root}/resources/publishable/sass" => resource_path('sass'),
            "{$this->root}/resources/publishable/js" => resource_path('js'),
        ], "symlink-assets");

        $this->publishes([
            "{$this->root}/vite.config.js" => "vite.config.js",
        ], "symlink-vite");
    }
    // ----------------------------------------------------------------------------------------------------
    protected function loadComponents() {
        $this->loadViewComponentsAs('symlink', [
            'layouts-guest-layout' => GuestLayout::class,
            Notification::class,
        ]);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function registerRoutes() {
        $this->loadRoutesFrom("{$this->root}/routes/developer.php");
        $this->loadRoutesFrom("{$this->root}/routes/auth.php");
    }
    // ----------------------------------------------------------------------------------------------------
}
