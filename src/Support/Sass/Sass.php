<?php

namespace Symlink\LaravelHelper\Support\Sass;

class Sass {
    // ---------------------------------------------------------------
    // Properties
    // ---------------------------------------------------------------
    protected $properties = []; 
    protected $options = []; // Initialize as an empty array
    // ---------------------------------------------------------------
    // Functions
    // ---------------------------------------------------------------
    public function __construct($options = []) {
        $this->options = array_merge([
            "file" => false,
        ], $options);
    }
    // ---------------------------------------------------------------
    public function setFile($file){
        $this->options['file'] = $file;
    }
    // ---------------------------------------------------------------
    public function add($property) {
        if (!is_array($property)) {
            return;
        }

        foreach ($property as $selector => $properties) {
            if (!isset($this->properties[$selector])) {
                $this->properties[$selector] = [];
            }

            // Merge properties, allowing overwrites
            $this->properties[$selector] = array_merge($this->properties[$selector], $properties);
        }
    }
    
    // ---------------------------------------------------------------
    public function writeTofile($file = false){
        if ($file) {
            $this->setFile($file);
        }

        $filePath = $this->options['file'];

        if (!$filePath) {
            abort(400, 'Missing File: Use setFile($file) or provide a file path to write.');
        }

        $scssContent = $this->build();
        
        // Ensure the directory exists
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // Create directory if it does not exist
        }

        // Write SCSS content to the file
        file_put_contents($filePath, $scssContent);

    }
    // ---------------------------------------------------------------
    public function build(){
        return $this->arrayToScss($this->properties);
    }
    
    // ---------------------------------------------------------------
    protected function arrayToScss($array, $indent = 0) {
        $scss = '';
        $indentation = str_repeat('    ', $indent);
    
        foreach ($array as $selector => $properties) {
            if (is_array($properties)) {
                $scss .= "{$indentation}{$selector} {\n";
                $scss .= $this->arrayToScss($properties, $indent + 1);
                $scss .= "{$indentation}}\n";
            } else {
                $scss .= "{$indentation}{$selector}: {$properties};\n";
            }
        }
    
        return $scss;
    }
    // ---------------------------------------------------------------
}
