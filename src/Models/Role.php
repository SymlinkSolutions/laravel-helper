<?php

namespace Symlink\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Symlink\LaravelHelper\Traits\HasCustomUuid;

class Role extends Model {
    use HasFactory, HasCustomUuid;

    protected $fillable = [
        "code",
        "name",
        "level",
        "uuid",
    ];
    // ----------------------------------------------------------------------
    // Relationships
    // ----------------------------------------------------------------------
    public function users() {
        return $this->belongsToMany(User::class);
    }
    // ----------------------------------------------------------------------
    // Functions
    // ----------------------------------------------------------------------
    public static function syncWithClasslist() {
        $app_roles = app_path('Helpers/Roles');
        $package_roles = __DIR__."/../Helpers/Roles";
        $app_role_classlist = [];
        $package_role_classlist = [];

        if (File::exists($app_roles))
            $app_role_classlist = $files = File::files($app_roles);
        if (File::exists($package_roles))
            $package_role_classlist = $files = File::files($package_roles);

        $classlist = array_merge($app_role_classlist, $package_role_classlist);
        
        foreach ($classlist as $file) {
            $relativePath = $file->getRelativePathname();
            $namespace = str_contains($file->getPathname(), 'app/Helpers/Roles') ? 'App\\Helpers\\Roles\\' : 'Symlink\\LaravelHelper\\Helpers\\Roles\\'; // Adjust this namespace as necessary
            $className = $namespace . str_replace(['/', '.php'], ['\\', ''], $relativePath);

            if (class_exists($className)) {
                $instance = new $className();
                $role = Role::where("code", $instance->getCode())->first();
                if (!$role){
                    $role = Role::create([
                        "name" => $instance->getName(),
                        "code" => $instance->getCode(),
                        "level" => $instance->getLevel(),
                    ]);
                } else {
                    if (
                        $role->name != $instance->getName() || 
                        $role->level != $instance->getLevel() ||
                        $role->code != $instance->getCode()
                    ) {
                        $role->update([
                            "name" => $instance->getName(),
                            "code" => $instance->getCode(),
                            "level" => $instance->getLevel(),
                        ]);
                    }
                }
            }
        }
    }
    // ----------------------------------------------------------------------
}
