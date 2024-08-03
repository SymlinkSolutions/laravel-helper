<?php

namespace Symlink\LaravelHelper\Support\Sass;

use Symlink\LaravelHelper\Services\ConfigIniService;

class Sass {
    // ---------------------------------------------------------------
    // Properties
    // ---------------------------------------------------------------
    protected $properties = []; 
    protected $string_properties = []; 
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
    public function add($mixed) {
        if (is_array($mixed))
            $this->add_array($mixed);

        if (is_string($mixed)) 
            $this->add_string($mixed);
        
    }
    // ---------------------------------------------------------------
    public function add_string($string) {
        $this->string_properties[] = $string;
    }
    // ---------------------------------------------------------------
    public function add_array($property) {
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
        $complete_string = $this->arrayToScss($this->string_properties);
        return $complete_string ."\n". $this->arrayToScss($this->properties);
    }
    
    // ---------------------------------------------------------------
    public function write_bootstrap_theme_colors($default = false) {
        $file = resource_path("sass/generated/bootstrap_theme_colors.scss");
        $ini = new ConfigIniService();

        $colors = [
            "primary" => $ini->get('bs_primary'),
            "secondary" => $ini->get('bs_secondary'),
            "success" => $ini->get('bs_success'),
            "info" => $ini->get('bs_info'),
            "warning" => $ini->get('bs_warning'),
            "danger" => $ini->get('bs_danger'),
            "light" => $ini->get('bs_light'),
            "dark" => $ini->get('bs_dark'),
        ];
        $replace_string = "";
        foreach ($colors as $color => $value){
            if (!$value) continue;
            $replace_string .= <<<EOD
            \${$color}: {$value}; \n
            EOD;
        }
        $this->add($replace_string);
        
        $this->writeTofile($file);
    }
    // ---------------------------------------------------------------
    protected function arrayToScss($array, $indent = 0) {
        $scss = '';
        $indentation = str_repeat('    ', $indent);

        foreach ($array as $key => $item) {
            if (is_array($item)) {
                // Handle nested arrays
                $scss .= "{$indentation}{$key} {\n";
                $scss .= $this->arrayToScss($item, $indent + 1);
                $scss .= "{$indentation}}\n";
            } elseif (is_string($key) && !is_array($item)) {
                // Handle array of strings as SCSS variables
                $scss .= "{$indentation}{$key}: {$item};\n";
            } elseif (is_string($item)) {
                // Handle standalone SCSS strings
                $scss .= "{$indentation}{$item}\n";
            }
        }

        return $scss;
    }
    // ---------------------------------------------------------------
}
