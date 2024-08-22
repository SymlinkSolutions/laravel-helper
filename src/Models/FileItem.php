<?php

namespace Symlink\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symlink\LaravelHelper\Enums\FileItem\FileItemTypeEnum;
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
        "file_item_id",
        "file_item_type",
    ];

    public function file_item() {
        return $this->hasOne(FileData::class);
    }

    public function model() {
        return $this->morphTo();
    }

    public function scopeGroup($query, $group = 'default')
    {
        return $query->where('group', $group);
    }

    public function scopeType($query, $type = FileItemTypeEnum::ORIGINAL->name)
    {
        return $query->where('file_item_type', $type);
    }

    
}
