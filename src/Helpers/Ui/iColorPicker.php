<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class iColorPicker implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    protected $name;
    protected $options;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($name, $label, $value = '', $options = []) {
        $this->options = array_merge([
            'name' => $name,
            'label' => $label,
            'hidden' => false,
            'value' => $value,
            'title' => false,
        ], $options);
        $this->name = $name;
    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        
        return $this->view('symlink::components.input.icolor_picker');
    }
    
    // ----------------------------------------------------------------------------------------------------
}
