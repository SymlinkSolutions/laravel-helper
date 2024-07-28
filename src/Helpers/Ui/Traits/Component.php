<?php

namespace Symlink\LaravelHelper\Helpers\Ui\Traits;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

trait Component {
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    /**
     * Extracts class list from the options array.
     * 
     * @return string
     */
    public function extract_classlist() {
        // Initialize an array to store class names
        $classList = [];

        // Iterate through the options array
        foreach ($this->options as $key => $value) {
            // Check if the key starts with '.' and the value is true
            if (strpos($key, '.') === 0 && $value === true) {
                // Remove the '.' from the key and add to class list
                $classList[] = substr($key, 1);
            }
        }

        // Return class names as a space-separated string
        return implode(' ', $classList);
    }
    // ----------------------------------------------------------------------------------------------------
    public function view($view) {
        $attr = [
            "errors" => Request::session()->get('errors'),
        ];

        if (!$this->options['value']) $this->options['value'] = Request::old($this->name);

        return View::make($view, array_merge($this->options, $attr))->render();
    }
    // ----------------------------------------------------------------------------------------------------

}