<?php

namespace App\Controllers\staff;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct()
    {

    }
        
    public function index()
    {
        $session = session();

        if (!$session->get("id") && $session->get('role')!="staff") {
            return redirect()->to('/');
        }

        echo view('Others/header');
        echo view('Staff/Dashboard');
        echo view('Others/fooder');
    }
}
