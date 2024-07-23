<?php

namespace Symlink\LaravelHelper;

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
        $this->app->singleton('form', function ($app) {
            return new \Symlink\LaravelHelper\Helpers\Ui\FormHelper();
        });
    }
    // ----------------------------------------------------------------------------------------------------
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel) {
        $this->app->alias('form', \Symlink\LaravelHelper\Facades\Form::class);

        $this->loadPublishes();
        $this->loadMigrationsFrom("{$this->root}/database/migrations");
        $this->loadViewsFrom("{$this->root}/resources/views", 'symlink');
        if ($this->app->runningInConsole()) {
            $this->loadCommands();
        }
        $this->registerRoutes();
        $this->loadComponents();
        $this->mergeAliases();

        // $kernel->pushMiddleware(CapitalizeTitle::class);
    }
    // ----------------------------------------------------------------------------------------------------
    // Other Functions
    // ----------------------------------------------------------------------------------------------------
    protected function mergeAliases() {
        // Define package aliases
        $packageAliases = [
            'Form' => \Symlink\LaravelHelper\Facades\Form::class,
            // Add other aliases here
        ];

        $configPath = base_path('config/app.php');

        // Check if the config file exists
        if (file_exists($configPath)) {
            $config = require $configPath;

            // Merge package aliases with existing aliases
            $existingAliases = $config['aliases'] ?? [];
            $mergedAliases = array_merge($existingAliases, $packageAliases);

            // Update the config file
            $config['aliases'] = $mergedAliases;

            // Write the updated config back to the file
            file_put_contents($configPath, "<?php\n\nreturn " . var_export($config, true) . ";\n");
        }
    }
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
            "{$this->root}/publishable/config/symlinkLaravelHelper.php" => config_path('symlinkLaravelHelper.php'),
        ], "symlink-config");

        $this->publishes([
            "{$this->root}/publishable/resources/sass" => resource_path('sass'),
            "{$this->root}/publishable/resources/js" => resource_path('js'),
        ], "symlink-assets");

        $this->publishes([
            "{$this->root}/publishable/vite.config.js" => "vite.config.js",
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
        $this->loadRoutesFrom("{$this->root}/routes/guest.php");
    }
    // ----------------------------------------------------------------------------------------------------
}
