<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class iHidden implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    protected $options;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($name, $value = '', $options = []) {
        $this->options = array_merge([
            'name' => $name,
            'value' => $value,
        ], $options);


    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {

        return $this->view('symlink::components.input.ihidden');
    }

    // ----------------------------------------------------------------------------------------------------
}
