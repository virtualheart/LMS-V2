<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        echo view('Others/header');
        echo view('About');
    }
}
