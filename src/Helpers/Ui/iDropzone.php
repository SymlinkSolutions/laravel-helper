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
        ], $options);

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
