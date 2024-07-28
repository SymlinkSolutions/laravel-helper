<?php

namespace Symlink\LaravelHelper\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSymlinkPackage extends Command {
    // ----------------------------------------------------------------------------------------------------
    // Properties
    // ----------------------------------------------------------------------------------------------------
    protected $root = __DIR__."/../..";
    protected $signature = 'symlink:install {--force : Overwrite any existing files}';
    protected $description = 'Install the Symlink package and run the resource setup';
    // ----------------------------------------------------------------------------------------------------
    // Functions
    // ----------------------------------------------------------------------------------------------------
    public function handle() {
        $this->info('Installing Symlink\LaravelHelper...');

        // Option to force the publish
        $force = $this->option('force');

        // Call the ResourceSetup command
        $this->call('symlink:resource-setup', [
            '--force' => $force
        ]);

        $this->call('symlink:setup-icons');

        $this->call('vendor:publish', [
            "--force" => $force,
            '--tag' => "symlink-vite"
        ]);

        $this->removeDefaultRoute();
        
        $this->setupViewsFolder($force);
        
        $this->call('migrate');

        $this->info('Installed Symlink\LaravelHelper');
    }
    // ----------------------------------------------------------------------------------------------------
    protected function setupViewsFolder($force) {
        if (!$force) return;
        $directories = [
            base_path("resources/views/system"),
            base_path("resources/views/emails"),
            base_path("resources/views/guest"),
            base_path("resources/views/website"),
        ];

        $viewsPath = resource_path('views');
        
        if (File::exists($viewsPath)) {
            File::deleteDirectory($viewsPath, true);
            $this->info('Cleared all views from ' . $viewsPath);
        } else {
            $this->info('Views folder does not exist.');
        }

        foreach ($directories as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
                $this->info("Created directory: $directory");
            }
        }
    }
    // ----------------------------------------------------------------------------------------------------
    protected function removeDefaultRoute() {
        $webRoutesPath = base_path('routes/web.php');

        if (!File::exists($webRoutesPath)) {
            $this->info('web.php file does not exist.');
            return;
        }

        $content = File::get($webRoutesPath);

        // Define the pattern to match the default route (assuming it's the default Laravel welcome route)
        $pattern = "/Route::get\('\/', function \(\) \{\s*return view\('welcome'\);\s*\}\);\s*/";

        // Remove the default route
        $newContent = preg_replace($pattern, '', $content);

        if ($content === $newContent) {
            $this->info('No default route found to remove.');
        } else {
            File::put($webRoutesPath, $newContent);
            $this->info('Default route has been removed from web.php.');
        }
    }
    // ----------------------------------------------------------------------------------------------------
}
