<?php

namespace Symlink\LaravelHelper\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasCustomUuid {

    protected static function booted()
    {
        static::creating(function ($model) {
            do {
                $uuid = Str::uuid();
                $query = self::where("uuid", $uuid);
                
                // Check if the model uses the SoftDeletes trait
                if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                    $query = $query->withTrashed();
                }
            } while ($query->exists());
        
            $model->uuid = $uuid;
        });

    }

    public function scopeUuid(Builder $query, $uuid) {
        return $query->where('uuid', $uuid);
    }

}
