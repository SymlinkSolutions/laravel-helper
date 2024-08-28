<?php

namespace Symlink\LaravelHelper\Support\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfGenerator {

    protected $pdf;

    protected $view;
    protected $data;
    protected $filename;


    public function __construct($view, $data = []) {
        $this->view = $view;
        $this->data = $data;

        $this->pdf = Pdf::loadView($this->view, $this->data);
    }

    public function download($filename = false) {
        if ($filename) $this->set_filename($filename);

        return $this->pdf->download($this->filename);
    }

    public function set_filename($filename) {
        $this->filename = $filename;
    }

}
