<?php

namespace Symlink\LaravelHelper\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Symlink\LaravelHelper\Observers\UserObserver;
use Symlink\LaravelHelper\Traits\HasCustomUuid;
use Symlink\LaravelHelper\Traits\HasProperties;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable {
    use HasFactory, Notifiable, HasProperties, HasCustomUuid;

    protected $properties_model = UserProperties::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'uuid',
        'first_name',
        'last_name',
        'id_nr',
        'cell_nr',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'id_nr' => 'hashed',
        ];
    }
}
