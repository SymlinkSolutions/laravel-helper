<?php

namespace Symlink\LaravelHelper\Facades;

use Illuminate\Support\Facades\Facade;
use Symlink\LaravelHelper\Helpers\Ui\iText;
use Symlink\LaravelHelper\Helpers\Ui\Submit;

class Form extends Facade
{
    protected static function getFacadeAccessor() {
        return 'form';
    }

    public static function itext($name, $label, $value='', $options=[]){
        $iText = new iText($name, $label, $value, $options);
        return $iText->build();
    }

    public static function submit($label, $options=[]){
        $submit = new Submit($label, $options);
        return $submit->build();
    }
}
