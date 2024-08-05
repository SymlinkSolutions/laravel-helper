<?php

namespace Symlink\LaravelHelper\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupIis extends Command {
    protected $signature = 'symlink:setup-iis';
    protected $description = 'Publish web.config';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $this->call('vendor:publish', [
            "--force" => true,
            '--tag' => "symlink-iis"
        ]);

        
    }
}
