<?php

namespace Symlink\LaravelHelper\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symlink\LaravelHelper\Traits\HasCustomUuid;

class BankingDetails extends Model {
    use HasFactory, HasCustomUuid;

    protected $fillable = [
        "uuid",
        "account_number",
        "bank_name",
        "branch_code",
        "user_id",
    ];

    protected $casts = [
        "account_number" => 'encrypted',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
