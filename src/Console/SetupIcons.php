<?php

namespace Symlink\LaravelHelper\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupIcons extends Command {
    protected $signature = 'symlink:setup-icons';
    protected $description = 'Publish Bootstrap Icons to the public directory';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $source = base_path('vendor/twbs/bootstrap-icons/font');
        $destination = public_path('fonts/bootstrap-icons');

        if (File::exists($destination)) {
            File::deleteDirectory($destination);
        }

        File::copyDirectory($source, $destination);

        $this->info('Bootstrap Icons published successfully.');
    }
}
