<?php

namespace Symlink\LaravelHelper\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Helper\Helper;
use Symlink\LaravelHelper\Support\String\Str;

class ConfigIniService {
    // ---------------------------------------------------------------------------------------
    // Properties
    // ---------------------------------------------------------------------------------------
    protected $path;
    protected $section = 'config';
    // ---------------------------------------------------------------------------------------
    // Functions
    // ---------------------------------------------------------------------------------------
    public function __construct() {
        $this->path = base_path("config.ini");
    }
    // ---------------------------------------------------------------------------------------
    protected function read() {
        return parse_ini_file($this->path, true);
    }
    // ---------------------------------------------------------------------------------------
    protected function write($config) {
        return $this->writeIniFile($config, $this->path, true);
    }
    // ---------------------------------------------------------------------------------------
    public function update($key, $value) {
        $config = $this->read();
        if (str_contains($value, "\"")){
            $value = Str::toBase64($value);
        }
        $config[$this->section][$key] = $value;
        return $this->write($config);
    }
    // ---------------------------------------------------------------------------------------
    public function get($key) {

        $config = $this->read();
        $value = $config[$this->section][$key] ?? false;
        if ($value && Str::isBase64Encoded($value)){
            return Str::fromBase64($value);
        } else if ($value) {
            return $value;
        }
        return false;
    }
    // ---------------------------------------------------------------------------------------
    public function delete($key) {
        $config = $this->read();
        unset($config[$this->section][$key]);
        return $this->write($config);
    }
    // ---------------------------------------------------------------------------------------
    protected function writeIniFile($assoc_arr, $path, $has_sections = false) {
        $content = "";
        if ($has_sections) {
            foreach ($assoc_arr as $key => $elem) {
                $content .= "[$key]\n";
                foreach ($elem as $key2 => $elem2) {
                    if (is_array($elem2)) {
                        for ($i = 0; $i < count($elem2); $i++) {
                            $content .= $key2 . "[] = \"" . $elem2[$i] . "\"\n";
                        }
                    } else if ($elem2 == "") {
                        $content .= $key2 . " = \n";
                    } else {
                        $content .= $key2 . " = \"" . $elem2 . "\"\n";
                    }
                }
            }
        } else {
            foreach ($assoc_arr as $key => $elem) {
                if (is_array($elem)) {
                    for ($i = 0; $i < count($elem); $i++) {
                        $content .= $key . "[] = \"" . $elem[$i] . "\"\n";
                    }
                } else if ($elem == "") {
                    $content .= $key . " = \n";
                } else {
                    $content .= $key . " = \"" . $elem . "\"\n";
                }
            }
        }

        if (!$handle = fopen($path, 'w')) {
            return false;
        }

        if (!fwrite($handle, $content)) {
            return false;
        }

        fclose($handle);
        return true;
    }
    // ---------------------------------------------------------------------------------------
}
