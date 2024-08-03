<?php

namespace Symlink\LaravelHelper\Models;

use App\Models\FileItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileData extends Model {
    use HasFactory;

    protected $table = "file_data";

    protected $fillable = [
        "data"
    ];

    public function file_item() {
        return $this->belongsTo(FileItem::class);
    }
}
