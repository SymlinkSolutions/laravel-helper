<?php

namespace Symlink\LaravelHelper\Helpers\Dropzone;

use Illuminate\Support\Facades\Log;
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

    /**
     * @param $options
     * @return array
     *
     *
     * This should be working for returning multiple cropped images
     */
    public function getFiles($options = []) {
        $options = array_merge([

        ], $options);
        $path = session("dropzone.path.{$this->id}");
        $storagePath = Storage::disk('public')->path($path);
        $files = Storage::disk('public')->files($path);

        $cropped_path = $path."/cropped";
        $cropped_files = Storage::disk('public')->files($cropped_path);
        $cropped_storagePath = Storage::disk('public')->path($cropped_path);

        $return_arr = [];
        foreach($files as $file){
            $basename = basename($file);
            $cropped_file = $cropped_files[array_search($cropped_path . "/cropped_".$basename, $cropped_files)];

            $return_arr[] = [
                "original" => $storagePath . "/" . basename($file),
                "cropped" => $cropped_storagePath . "/" . basename($cropped_file),
            ];
        }

        return $return_arr;
    }


}
