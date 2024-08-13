<?php

namespace Symlink\LaravelHelper\Helpers\Dropzone;

use Illuminate\Support\Facades\Storage;

class DropzoneHelper{
    protected $id;
    public function __construct($id){
        $this->id = $id;
    }

    public function clear_temp() {
        $path = session("dropzone.path.{$this->id}");
        Storage::disk('public')->deleteDirectory($path);
    }

    public function getFiles($options = []) {
        $options = array_merge([
            
        ], $options);
        $path = session("dropzone.path.{$this->id}");
        $storagePath = Storage::disk('public')->path($path);
        $files = Storage::disk('public')->allFiles($path);
        
        $return_arr = [];
        foreach($files as $file){
            $return_arr[] = $storagePath . "/" . basename($file);
        }
    
        return $return_arr;
    }
    

}