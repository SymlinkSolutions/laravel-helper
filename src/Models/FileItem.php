<?php

namespace Symlink\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symlink\LaravelHelper\Traits\HasCustomUuid;

class FileItem extends Model {
    use HasFactory, HasCustomUuid;

    protected $fillable = [
        "file_data_id",
        "file_name",
        "file_extension",
        "file_size",
        "user_id",
        "model_type",
        "model_id",
        "group",
        "disk",
        "mime_type",
        "path",
    ];

    public function file_item() {
        return $this->hasOne(FileData::class);
    }

    public function model() {
        return $this->morphTo();
    }

}
