<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


class Uploadbooks extends BaseController
{
    public function __construct()
    {

    }
        
    public function index()
    {

        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }
        
        echo view('Others/header');
        echo View('Admin/AdminBookUpload');
        echo view('Others/fooder');
        
    }
}