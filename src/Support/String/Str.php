<?php

namespace Symlink\LaravelHelper\Support\String;

class Str extends \Illuminate\Support\Str {
    //-----------------------------------------------------------------------------------------------------
    public static function isBase64Encoded($string) {
        if (preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) {
            $decoded = base64_decode($string, true);
            if ($decoded !== false && base64_encode($decoded) === $string) {
                return true;
            }
        }
        return false;
    }
    //-----------------------------------------------------------------------------------------------------
    public static function generateCompoenentId($prefix = "id"){
        return $prefix ."_". Str::random(8);
    }
    //-----------------------------------------------------------------------------------------------------

}