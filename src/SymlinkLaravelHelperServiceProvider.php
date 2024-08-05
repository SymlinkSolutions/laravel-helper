<?php

namespace Symlink\LaravelHelper;

use Illuminate\Support\ServiceProvider;
use Symlink\LaravelHelper\Console\InstallSymlinkPackage;
use Symlink\LaravelHelper\View\Components\Notification;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Symlink\LaravelHelper\Console\CreateDeveloper;
use Symlink\LaravelHelper\Console\ResourceSetup;
use Symlink\LaravelHelper\Console\SetupIcons;
use Symlink\LaravelHelper\Console\SetupIis;
use Symlink\LaravelHelper\Http\Middleware\Auth\Role;
use Symlink\LaravelHelper\View\Components\Layouts\AuthLayout;
use Symlink\LaravelHelper\View\Components\Layouts\DevLayout;
use Symlink\LaravelHelper\View\Components\Layouts\GuestLayout;
use Symlink\LaravelHelper\View\Components\Spinner;

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
    }
    // ----------------------------------------------------------------------------------------------------
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel, Router $router) {
        $this->bootAliases();
        $this->loadPublishes();
        $this->loadMigrationsFrom("{$this->root}/database/migrations");
        $this->loadViewsFrom("{$this->root}/resources/views", 'symlink');
        if ($this->app->runningInConsole()) {
            $this->loadCommands();
        }
        $this->registerRoutes();
        $this->loadComponents();

        $router->aliasMiddleware("role", Role::class);

        Blade::if('role', function ($role) {
            /**
             * @var App\Models\User
             */
            $user = auth()->user();
            return auth()->check() && $user->hasRole($role);
        });

        // $this->mergeAliases();

        // $kernel->pushMiddleware(CapitalizeTitle::class);
    }
    // ----------------------------------------------------------------------------------------------------
    // Other Functions
    // ----------------------------------------------------------------------------------------------------
    protected function bootAliases(){
        $this->app->alias("form", \Symlink\LaravelHelper\Facades\Form::class);
        $this->app->alias("html", \Symlink\LaravelHelper\Facades\Html::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('Html', \Symlink\LaravelHelper\Facades\Html::class);
        $loader->alias('Form', \Symlink\LaravelHelper\Facades\Form::class);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function mergeAliases() {
        // Define package aliases
        $packageAliases = [
            'Form' => \Symlink\LaravelHelper\Facades\Form::class,
            'Html' => \Symlink\LaravelHelper\Facades\Html::class,
        ];

        $aliases = config("app.aliases");
        $allAiases = array_merge($aliases, $packageAliases);

        config([
            "app.aliases" => $allAiases
        ]);

    }
    // ----------------------------------------------------------------------------------------------------
    protected function loadCommands() {
        $this->commands([
            InstallSymlinkPackage::class,
            ResourceSetup::class,
            SetupIcons::class,
            SetupIis::class,
            CreateDeveloper::class,
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

        $this->publishes([
            "{$this->root}/publishable/app/Http/Models/" => app_path("Models/"),
        ], "symlink-models");

        $this->publishes([
            "{$this->root}/publishable/public/web.config" => public_path("web.config"),
        ], "symlink-iis");
    }
    // ----------------------------------------------------------------------------------------------------
    protected function loadComponents() {
        $this->loadViewComponentsAs('symlink', [
            'layouts-guest-layout' => GuestLayout::class,
            'layouts-auth-layout' => AuthLayout::class,
            'layouts-dev-layout' => DevLayout::class,
            Notification::class,
            Spinner::class,
        ]);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function registerRoutes() {
        $this->loadRoutesFrom("{$this->root}/routes/developer.php");
        $this->loadRoutesFrom("{$this->root}/routes/auth.php");
        $this->loadRoutesFrom("{$this->root}/routes/files.php");
        $this->loadRoutesFrom("{$this->root}/routes/guest.php");
        $this->loadRoutesFrom("{$this->root}/routes/dropzone.php");
    }
    // ----------------------------------------------------------------------------------------------------
}
