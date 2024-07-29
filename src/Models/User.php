<?php

namespace Symlink\LaravelHelper\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
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
        'remember_token',
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
    // ------------------------------------------------------------------------------------------
    public function roles() {
        return $this->belongsToMany(Role::class);
    }
    // ------------------------------------------------------------------------------------------
    public function removeRole($class) {
        if ($this->hasRole($class)){
            $this->roles()->detach($class->getObj()->id);
        }
    }
    // ------------------------------------------------------------------------------------------
    public function addRole($class) {
        if (!$this->hasRole($class)){
            $this->roles()->attach($class->getObj()->id);
        }
    }
    // ------------------------------------------------------------------------------------------
    public function hasRole($class) {
        $classes = Arr::wrap($class);
        $classInstances = array_map(function($class) {
            if (is_string($class)) {
                // Try to instantiate the class from the two locations
                $className = $this->getClassName($class);
                if (class_exists($className)) {
                    return new $className;
                } else {
                    // Try the second namespace
                    $className = 'Symlink\LaravelHelper\Helpers\Roles\\' . $class;
                    if (class_exists($className)) {
                        return new $className;
                    }
                }
                // If the class does not exist in either namespace, return null
                return null;
            }
            return $class;
        }, $classes);

        // Filter out null values (classes that could not be instantiated)
        $classInstances = array_filter($classInstances);

        // Check if the user has any of the roles
        foreach ($classInstances as $classInstance) {
            if ($this->roles()->where('code', $classInstance->getCode())->exists()) {
                return true;
            }
        }

        return false;
    }
    // ------------------------------------------------------------------------------------------
    protected function getClassName($class)  {
        // Check in the first namespace
        $className = 'App\Helpers\Roles\\' . $class;
        if (class_exists($className)) {
            return $className;
        }

        // If not found, check in the second namespace
        return 'Symlink\LaravelHelper\Helpers\Roles\\' . $class;
    }
    // ------------------------------------------------------------------------------------------
}
