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

        $this->call('vendor:publish', [
            "--force" => $force,
            '--tag' => "symlink-vite"
        ]);

        $this->removeDefaultRoute();

        $this->info('Installed Symlink\LaravelHelper');
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
