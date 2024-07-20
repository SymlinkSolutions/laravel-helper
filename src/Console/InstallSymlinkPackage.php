<?php

namespace Symlink\LaravelHelper\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSymlinkPackage extends Command {

    protected $signature = 'symlink:install';

    public function handle() {
        $this->info('Installing Symlink\LaravelHelper...');

        $this->info('Publishing configuration...');

        // if (!$this->configExists('blogpackage.php')) {
        //     $this->publishConfiguration();
        //     $this->info('Published configuration');
        // } else {
        //     if ($this->shouldOverwriteConfig()) {
        //         $this->info('Overwriting configuration file...');
        //         $this->publishConfiguration($force = true);
        //     } else {
        //         $this->info('Existing configuration was not overwritten');
        //     }
        // }

        $this->info('Installed Symlink\LaravelHelper');
    }

    private function configExists($fileName)  {
        return File::exists(config_path($fileName));
    }

    private function publishConfiguration($forcePublish = false) {
        $params = [
            '--provider' => "JohnDoe\BlogPackage\BlogPackageServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
