<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class iDropzone implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    protected $options;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($name, $path = "/", $options = []) {
        $this->options = array_merge([
            "existingFiles" => [],
            "name" => false,
            "label" => "Drop files here to upload.",
            "limit" => 5,
            "acceptedFiles" => "image/*",
            "id" => $name,
            "csrf_token" => csrf_token(),
            "path" => "temp".$path,

            "cropped_path" => false,
            "crop" => false,
            "crop_height" => 1080,
            "crop_width" => 1920,
            "crop_aspect_ratio" => "1 / 1",

        ], $options);

        if ($this->options['crop']) $this->options['limit'] = 1;
        $this->options['crop_aspect_ratio'] = "{$this->options['crop_width']} / {$this->options['crop_height']}";

        session(["dropzone.path.{$name}" => $this->options['path']]);

        $this->options['existingFiles'] = $this->getExistingFiles();
    }
    // ----------------------------------------------------------------------------------------------------
    public function getExistingFiles() {
        $existingFiles = [];
        $path = $this->options['path'];
        if ($path) {
            $files = Storage::disk('public')->files($path);
            foreach ($files as $file) {
                $existingFiles[] = [
                    'name' => basename($file),
                    'size' => Storage::disk('public')->size($file),
                    'path' => Storage::url($file),
                ];
            }
        }
        return $existingFiles;
    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        return View::make('symlink::components.input.idropzone', $this->options)->render();
    }

    // ----------------------------------------------------------------------------------------------------
}
