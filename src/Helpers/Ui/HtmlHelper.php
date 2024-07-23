<?php

namespace Symlink\LaravelHelper\Helpers\Ui;


class HtmlHelper {
    
    /**
     * Generate an HTML image element.
     *
     * @param string $src The source URL of the image.
     * @param array $options Additional HTML attributes for the image element.
     * @return string The generated HTML for the image element.
     */
    public static function image($src = false, $options=[]){
        $iText = new Image($src, $options);
        return $iText->build();
    }


}
