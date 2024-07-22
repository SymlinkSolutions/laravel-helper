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

        // Replace vite.config.js
        $this->replaceViteConfig($force);

        $this->info('Installed Symlink\LaravelHelper');
    }
    // ----------------------------------------------------------------------------------------------------
    protected function replaceViteConfig($force) {
        $viteConfigSource = "{$this->root}/vite.config.js";
        $viteConfigDestination = base_path('vite.config.js');

        if (File::exists($viteConfigDestination) && !$force) {
            $this->info('vite.config.js already exists and was not overwritten.');
            return;
        }

        File::copy($viteConfigSource, $viteConfigDestination);
        $this->info('vite.config.js has been replaced.');
    }
    // ----------------------------------------------------------------------------------------------------
}
