<?php

namespace Symlink\LaravelHelper\Traits;

use App\Models\FileItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait HasFiles {
    // ------------------------------------------------------------------------------------------
    public function files() {
        return $this->morphMany(FileItem::class, 'model');
    }
    // ------------------------------------------------------------------------------------------
    public function addFile($path, $disk = false, $options = []){
        $options = array_merge([
            "group" => "default",
            "path" => false,
        ], $options);
        if (!$disk) $disk = config("filesystems.default");
        
        /**
         * @var App\Models\User;
         */
        $active_user = Auth::user();
        $id = ($active_user) ? $active_user->id : false;

        $filename = File::basename($path);
        $mimetype = File::mimeType($path);
        $extension = File::extension($path);
        $size = File::size($path);

        if (!$options["path"]){
            $max_id = DB::table('file_items')->max('id');
            $max_id = $max_id + 1;
            $options['path'] = "{$max_id}/";
        }

        $new_file_item = new FileItem([
            "disk" => $disk,
            "file_name" => $filename,
            "file_extension" => $extension,
            "mime_type" => $mimetype,
            "group" => $options['group'],
            "size" => $size,
            "user_id" => $id,
            "path" => $options['path'],
        ]);

        $file_item = $this->files()->save($new_file_item);

        Storage::disk($disk)->putFileAs($file_item->path, $path, $file_item->file_name);
    }
    // ------------------------------------------------------------------------------------------
}
