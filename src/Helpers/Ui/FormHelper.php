<?php

namespace Symlink\LaravelHelper\Helpers\Ui;


class FormHelper {
    public static function itext($name, $label, $value='', $options=[]){
        $iText = new iText($name, $label, $value, $options);
        return $iText->build();
    }

}
