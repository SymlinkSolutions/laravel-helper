<?php

namespace Symlink\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProperties extends Model {
    protected $fillable = [
        'key',
        'value',
        'user_id',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

}
