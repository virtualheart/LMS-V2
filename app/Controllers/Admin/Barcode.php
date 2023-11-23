<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use Picqer\Barcode;


class Barcode extends BaseController
{
    public function index()
    {
        // This will output the barcode as HTML output to display in the browser
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
    }
}
