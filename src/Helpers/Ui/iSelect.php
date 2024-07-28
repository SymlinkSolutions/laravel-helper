<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class iSelect implements FormInput {
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
    public function __construct($name, $label, $data = [], $value = false, $options = []) {
        $this->options = array_merge([
            'id' => $name,
            'label' => $label,
            'value' => $value,
            "data" => $data
        ], $options);


        $this->name = $name;
        $this->value = $value;
    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        
        return $this->view('symlink::components.input.iselect');
    }
    
    // ----------------------------------------------------------------------------------------------------
}
