<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class iText implements FormInput {
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
    public function __construct($name, $label, $value = '', $options = []) {
        $this->options = array_merge([
            'id' => $name,
            'label' => $label,
            'type' => 'text',
            'hidden' => false,
        ], $options);


        $this->name = $name;
        $this->value = $value;
    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        $error = $this->hasError($this->name);
        $errorMessage = $this->getErrorMessage($this->name);

        if ($this->options['hidden']) 
            $this->options['type'] = "password";

        return View::make('symlink::components.input.itext', $this->options)->render();
    }
    // ----------------------------------------------------------------------------------------------------
    protected function hasError($id) {
        // Check for validation errors in the session
        return Session::has('errors') && Session::get('errors')->has($id);
    }
    // ----------------------------------------------------------------------------------------------------
    protected function getErrorMessage($id) {
        // Retrieve the first error message for the given field
        if (Session::has('errors')) {
            $errors = Session::get('errors');
            return $errors->first($id);
        }
        return '';
    }
    // ----------------------------------------------------------------------------------------------------
    protected function getOldValue($id) {
        // Retrieve old input value from the session
        return old($id, $this->value);
    }
    // ----------------------------------------------------------------------------------------------------
}
