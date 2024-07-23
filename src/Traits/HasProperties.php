<?php

namespace Symlink\LaravelHelper\Traits;

trait HasProperties {

    public function properties() {
        return $this->hasMany($this->properties_model);
    }


}
