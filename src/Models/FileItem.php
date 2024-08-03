<?php

namespace Symlink\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileItem extends Model {
    use HasFactory;

    protected $fillable = [
        "file_data_id",
        "file_name",
        "file_extension",
        "file_size",
        "user_id",
    ];

    public function file_item() {
        return $this->hasOne(FileData::class);
    }

    public function model() {
        return $this->morphTo();
    }
}
