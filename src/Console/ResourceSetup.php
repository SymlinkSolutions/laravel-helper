<?php

namespace Symlink\LaravelHelper\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class ResourceSetup extends Command {
    // ----------------------------------------------------------------------------------------------------
    // Properties
    // ----------------------------------------------------------------------------------------------------
    protected $signature = 'symlink:resource-setup {--force : Force overwrite of existing files}';
    protected $description = 'Publish package resources and create symbolic links';

    private $root;
    // ----------------------------------------------------------------------------------------------------
    // Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->root = base_path('packages/symlink/laravel-helper');
    }
    // ----------------------------------------------------------------------------------------------------
    public function handle() {
        $this->info('Setting up resources...');
        
        $forcePublish = $this->option('force');

        // Publish resources
        $this->publishResources($forcePublish);
        
        // Create CSS directory
        $this->createCssDirectory();
        
        // Create symbolic links
        // $this->createSymbolicLinks();
        
        $this->info('Resource setup completed.');
    }
    // ----------------------------------------------------------------------------------------------------
    private function publishResources($force = false) {
        $this->info('Publishing resources...');

        $params = [
            '--tag' => "symlink-assets"
        ];
        
        if ($force) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
    // ----------------------------------------------------------------------------------------------------
    private function createCssDirectory() {
        $cssPath = resource_path('css');
        
        if (!File::exists($cssPath)) {
            File::makeDirectory($cssPath, 0755, true);
            $this->info('Created css directory.');
        } else {
            $this->info('CSS directory already exists.');
        }
    }
    // ----------------------------------------------------------------------------------------------------
}
