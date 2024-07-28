<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class iCheckbox implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    protected $name;
    protected $value;
    protected $options;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($name, $label, $value = false, $options = []) {
        $this->options = array_merge([
            'name' => $name,
            'label' => $label,
            'value' => $value,
        ], $options);


        $this->name = $name;
        $this->value = $value;
    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        
        return $this->view('symlink::components.input.icheckbox');
    }
    
    // ----------------------------------------------------------------------------------------------------
}
