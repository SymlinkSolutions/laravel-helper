<?php

namespace Symlink\LaravelHelper\Helpers\Dropzone;

use Illuminate\Support\Facades\Storage;

class DropzoneHelper{

    public function clear_temp() {
        $path = session("dropzone.path");
        Storage::deleteDirectory($path);
    }


}