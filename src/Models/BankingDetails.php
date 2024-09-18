<?php

namespace Symlink\LaravelHelper\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symlink\LaravelHelper\Traits\HasCustomUuid;

class BankingDetails extends Model {
    use HasFactory, HasCustomUuid;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
