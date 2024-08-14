<?php

namespace Symlink\LaravelHelper\Http\Controllers\System\Index;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symlink\LaravelHelper\Helpers\Dropzone\DropzoneHelper;
use Symlink\LaravelHelper\Services\ConfigIniService;
use Symlink\LaravelHelper\Support\DotEnv\DotEnv;
use Symlink\LaravelHelper\Support\Sass\Sass;

class HomeController extends Controller {
    // --------------------------------------------------------------------------------------------
    public function showHome() {
        return view('symlink::system.index.home');
    }
    // --------------------------------------------------------------------------------------------
}
