<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function index()  
    {  
        $session = Session();
        $session->destroy();
        return redirect()->to('/');
    }
}