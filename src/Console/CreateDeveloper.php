<?php

namespace Symlink\LaravelHelper\Console;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symlink\LaravelHelper\Helpers\Roles\Developer;

class CreateDeveloper extends Command {
    protected $signature = 'symlink:dev';
    protected $description = 'Make a User a developer';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $email = $this->ask('Account Email:');

        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->info("User Not Found!");
            return;
        }

        $user->addRole(new Developer);

        
    }
}
