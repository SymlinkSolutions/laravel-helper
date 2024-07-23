<?php

namespace Symlink\LaravelHelper\Helpers\Ui\Traits;


trait Component {

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

}
