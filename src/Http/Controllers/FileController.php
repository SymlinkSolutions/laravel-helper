<?php

namespace Symlink\LaravelHelper\Http\Controllers;

use App\Models\FileItem;
use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PDO;
use Symlink\LaravelHelper\Support\String\Str;

class FileController extends Controller {

    public function stream($id) {
        if (Str::isUuid($id)){
            $file_item = FileItem::uuid($id);
        } else {
            $file_item = FileItem::find($id);
        }
        
        if (!$file_item) {
            return response()->json(['message' => 'File Item not found'], 404);
        }
        if (!$file_item->disk || !$file_item->file_name || !$file_item->path){
            return response()->json(['message' => 'Missing File Data'], 404);
        }

        $file = Storage::disk($file_item->disk)->get($file_item->path . $file_item->file_name);

        if (!$file) {
            return response()->json(['message' => 'File Does Not Exist'], 404);
        }

        return response($file, 200)->header('Content-Type', "");
    }
}
