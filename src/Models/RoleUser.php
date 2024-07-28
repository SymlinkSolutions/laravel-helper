<?php

namespace Symlink\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symlink\LaravelHelper\Traits\HasCustomUuid;

class RoleUser extends Model {
    use HasFactory, HasCustomUuid;
}
